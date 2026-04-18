<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\InvoiceItem;
use Illuminate\Support\Facades\DB;
use App\Mail\InvoiceMail;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }


    /**
     * List invoice
     */

    public function index(Request $request)
    {
        $query = Invoice::with('customer')->select('id', 'invoice_number', 'tanggal', 'customer_id', 'kota_tujuan', 'created_at', 'pengirim', 'total');

        // 🔍 SEARCH
        if ($request->filled('q')) {
            $q = $request->q;

            $query->where(function ($sub) use ($q) {
                $sub->where('invoice_number', 'like', "%{$q}%")
                    ->orWhere('kota_tujuan', 'like', "%{$q}%")
                    ->orWhereHas('customer', function ($customer) use ($q) {
                        $customer->where('nama_toko', 'like', "%{$q}%");
                    });
            });
        }

        // 📅 FILTER START DATE
        if ($request->filled('start_date')) {
            $query->whereDate('tanggal', '>=', $request->start_date);
        }

        // 📅 FILTER END DATE
        if ($request->filled('end_date')) {
            $query->whereDate('tanggal', '<=', $request->end_date);
        }

        $items = $query
            ->latest()
            ->paginate(10)
            ->withQueryString(); // penting

        // echo '<pre>';
        // print_r($items);
        // echo '</pre>';


        return view('pages.invoice.index', compact('items'));
    }


    /**
     * Form create invoice
     */
    public function create()
    {
        $customers = Customer::orderBy('nama_toko')->get();

        return view('pages.invoice.create', compact('customers'));
    }

    /**
     * Store invoice (HEADER ONLY dulu)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal'      => ['required', 'date'],
            'customer_id'  => ['required', 'uuid', 'exists:customers,id'],
            'kota_asal'    => ['required', 'string', 'max:100'],
            'kota_tujuan'  => ['required', 'string', 'max:100'],
            'supir'        => ['nullable', 'string', 'max:100'],
            'no_polisi'    => ['nullable', 'string', 'max:20'],
            'pengirim'     => ['required', 'string', 'max:100'],

            'items' => ['required', 'array', 'min:1'],
            'items.*.coli' => ['nullable', 'integer', 'min:0'],
            'items.*.code' => ['nullable', 'string', 'max:50'],
            'items.*.jenis_barang' => ['required', 'string', 'max:255'],
            'items.*.berat' => ['required', 'numeric', 'min:0'],
            'items.*.ongkos_per_kg' => ['required', 'numeric', 'min:0'],
        ]);

        DB::transaction(function () use ($validated, &$invoice) {

            $invoice = Invoice::create([
                'invoice_number' => $this->generateInvoiceNumber(),
                'tanggal'        => $validated['tanggal'],
                'customer_id'    => $validated['customer_id'],
                'pengirim'       => $validated['pengirim'],
                'kota_asal'      => $validated['kota_asal'],
                'kota_tujuan'    => $validated['kota_tujuan'],
                'supir'          => $validated['supir'] ?? null,
                'no_polisi'      => $validated['no_polisi'] ?? null,
                'created_by'     => Auth::id(),
                'total'          => 0,
            ]);

            $totalInvoice = 0;

            foreach ($validated['items'] as $item) {
                $totalOngkos = $item['berat'] * $item['ongkos_per_kg'];

                $invoice->items()->create([
                    'coli'          => $item['coli'] ?? null,
                    'code'          => $item['code'] ?? null,
                    'jenis_barang'  => $item['jenis_barang'],
                    'berat'         => $item['berat'],
                    'ongkos_per_kg' => $item['ongkos_per_kg'],
                    'total_ongkos'  => $totalOngkos,
                ]);

                $totalInvoice += $totalOngkos;
            }

            $invoice->update([
                'total' => $totalInvoice,
            ]);
        });

        return redirect()
            ->route('invoice.show', $invoice->id)
            ->with('notification', $this->successNotification(
                'notification.store_success',
                'menu.invoice'
            ));
    }

    /**
     * Show invoice
     */
    public function show(Invoice $invoice)
    {
        $invoice->load('customer');

        return view('pages.invoice.show', compact('invoice'));
    }

    /**
     * Edit invoice (header)
     */
    public function edit(Invoice $invoice)
    {
        $invoice = Invoice::with('items')->findOrFail($invoice->id);

        return view('pages.invoice.edit', [
            'invoice' => $invoice,
            'customers' => Customer::all(),
        ]);
    }



    /**
     * Update invoice
     */
    public function update(Request $request, Invoice $invoice)
    {
        $validated = $request->validate([
            'tanggal' => ['required', 'date'],
            'customer_id' => ['required', 'uuid', 'exists:customers,id'],
            'kota_asal' => ['required', 'string', 'max:100'],
            'kota_tujuan' => ['required', 'string', 'max:100'],
            'supir' => ['nullable', 'string', 'max:100'],
            'no_polisi' => ['nullable', 'string', 'max:20'],
            'pengirim' => ['nullable', 'string', 'max:255'],

            'items' => ['required', 'array'],
            'items.*.jenis_barang' => ['required', 'string'],
            'items.*.berat' => ['required', 'numeric'],
            'items.*.ongkos_per_kg' => ['required', 'numeric'],
            'items.*.total_ongkos' => ['required', 'numeric'],
            'items.*.coli' => ['nullable', 'integer'],
            'items.*.code' => ['nullable', 'string'],
        ]);

        DB::transaction(function () use ($request, $invoice) {

            $invoice->update([
                'tanggal' => $request->tanggal,
                'customer_id' => $request->customer_id,
                'kota_asal' => $request->kota_asal,
                'kota_tujuan' => $request->kota_tujuan,
                'supir' => $request->supir,
                'no_polisi' => $request->no_polisi,
                'pengirim' => $request->pengirim,
            ]);

            $totalInvoice = 0;
            $existingIds = [];

            foreach ($request->items as $item) {

                $data = [
                    'coli' => $item['coli'],
                    'code' => $item['code'],
                    'jenis_barang' => $item['jenis_barang'],
                    'berat' => $item['berat'],
                    'ongkos_per_kg' => $item['ongkos_per_kg'],
                    'total_ongkos' => $item['total_ongkos'],
                ];

                if (!empty($item['id'])) {
                    $invoiceItem = $invoice->items()->where('id', $item['id'])->first();
                    $invoiceItem->update($data);
                    $existingIds[] = $invoiceItem->id;
                } else {
                    $invoiceItem = $invoice->items()->create($data);
                    $existingIds[] = $invoiceItem->id;
                }

                $totalInvoice += $data['total_ongkos'];
            }

            $invoice->items()->whereNotIn('id', $existingIds)->delete();

            $invoice->update(['total' => $totalInvoice]);
        });


        return redirect()
            ->route('invoice.show', $invoice->id)
            ->with('notification', $this->successNotification(
                'notification.update_success',
                'menu.invoice'
            ));
    }

    /**
     * Delete invoice
     */
    public function destroy(Invoice $invoice)
    {
        $invoiceId = $invoice->id;

        $invoice->delete();

        \Binafy\LaravelUserMonitoring\Models\ActionMonitoring::create([
            'user_id' => auth()->id(),
            'action_type' => 'delete',
            'table_name' => 'invoices',
            'ip' => request()->ip(),
            'browser_name' => request()->header('User-Agent'),
            'platform' => php_uname(),
            'device' => php_uname(),
            'page' => request()->fullUrl(),
        ]);

        return redirect()
            ->route('invoice.index')
            ->with('notification', $this->successNotification(
                'notification.delete_success',
                'menu.invoice'
            ));
    }

    /**
     * Generate nomor invoice
     * contoh: INV-2024-0001
     */
    protected function generateInvoiceNumber(): string
    {
        $count = Invoice::count() + 1;
        return 'INV-' . date('Y') . '-' . str_pad($count, 4, '0', STR_PAD_LEFT);
    }



    public function send(Invoice $invoice)
    {
        Mail::to($invoice->customer->email)
            ->send(new InvoiceMail($invoice));
        $email = $invoice->customer->email ?? '-';
        return back()->with('notification', $this->successNotification(
            'Invoice berhasil dikirim via email ke ' . $email,
            'menu.invoice'
        ));
    }

    public function updatePayment(Request $request, Invoice $invoice)
    {
        // $this->authorize('update_invoice_payment_status');

        $request->validate([
            'status_pembayaran' => ['required', 'in:lunas,belum_lunas'],
        ]);

        $invoice->update([
            'status_pembayaran' => $request->status_pembayaran,
            'paid_at' => $request->status_pembayaran === 'lunas'
                ? now()
                : null,
            'paid_by' => $request->status_pembayaran === 'lunas'
                ? auth()->id()
                : null,
        ]);

        return back()->with(
            'notification',
            $this->successNotification(
                'Status pembayaran berhasil diperbarui',
                'menu.invoice'
            )
        );
    }

    public function downloadPdf(Invoice $invoice)
    {
        $invoice->load(['customer', 'items']);

        $pdf = Pdf::loadView('pdf.invoice', [
            'invoice' => $invoice
        ])->setPaper('A4', 'portrait');

        return $pdf->download(
            'Invoice-' . $invoice->invoice_number . '.pdf'
        );
    }
}

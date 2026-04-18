<?php

namespace App\Exports;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LaporanExport implements FromCollection, WithHeadings
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $query = Invoice::with('customer');

        // SEARCH
        if ($this->request->q) {
            $query->where(function ($q) {
                $q->where('invoice_number', 'like', "%{$this->request->q}%")
                    ->orWhereHas('customer', function ($q2) {
                        $q2->where('nama_toko', 'like', "%{$this->request->q}%");
                    });
            });
        }

        // STATUS
        if ($this->request->status) {
            $query->where('status_pembayaran', $this->request->status);
        }

        // DATE RANGE
        if ($this->request->start_date) {
            $query->whereDate('tanggal', '>=', $this->request->start_date);
        }

        if ($this->request->end_date) {
            $query->whereDate('tanggal', '<=', $this->request->end_date);
        }

        return $query->get()->map(function ($item) {
            return [
                'Invoice' => $item->invoice_number,
                'Tanggal' => $item->tanggal,
                'Customer' => $item->customer->nama_toko ?? '-',
                'Kota Tujuan' => $item->kota_tujuan,
                'Total' => $item->total,
                'Status' => $item->status_pembayaran,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Invoice',
            'Tanggal',
            'Customer',
            'Kota Tujuan',
            'Total',
            'Status',
        ];
    }
}

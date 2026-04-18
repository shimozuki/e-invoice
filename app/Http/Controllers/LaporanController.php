<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Exports\LaporanExport;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $year = $request->year ?? now()->year;

        $query = Invoice::with('customer');

        if ($request->q) {
            $query->where(function ($q) use ($request) {
                $q->where('invoice_number', 'like', "%{$request->q}%")
                    ->orWhereHas('customer', function ($q2) use ($request) {
                        $q2->where('nama_toko', 'like', "%{$request->q}%");
                    });
            });
        }

        if ($request->status) {
            $query->where('status_pembayaran', $request->status);
        }

        if ($request->year) {
            $query->whereYear('tanggal', $request->year);
        }

        if ($request->start_date) {
            $query->whereDate('tanggal', '>=', $request->start_date);
        }

        if ($request->end_date) {
            $query->whereDate('tanggal', '<=', $request->end_date);
        }

        $items = $query->latest()->paginate(10)->withQueryString();

        $summaryQuery = clone $query;

        $totalPendapatan = $summaryQuery->sum('total');

        $totalLunas = (clone $summaryQuery)
            ->where('status_pembayaran', 'lunas')
            ->sum('total');

        $totalBelumLunas = (clone $summaryQuery)
            ->where('status_pembayaran', 'belum_lunas')
            ->sum('total');

        return view('pages.laporan.index', compact(
            'items',
            'totalPendapatan',
            'totalLunas',
            'totalBelumLunas',
            'year'
        ));
    }

    public function export(Request $request)
    {
        return Excel::download(
            new LaporanExport($request),
            'laporan.xlsx'
        );
    }
}

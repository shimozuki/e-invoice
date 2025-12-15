<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\View\View;
use App\Models\Invoice;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function welcome(Request $request): View
    {
        return view('welcome');
    }

    public function dashboard(Request $request): View
    {
        $todayInvoiceTotal = Invoice::whereDate('tanggal', Carbon::today())
            ->count();

        $year = request('year', now()->year);

        $monthlyPaid = [];
        $monthlyUnpaid = [];

        for ($m = 1; $m <= 12; $m++) {
            $monthlyPaid[] = Invoice::whereYear('tanggal', $year)
                ->whereMonth('tanggal', $m)
                ->where('status_pembayaran', 'lunas')
                ->count();

            $monthlyUnpaid[] = Invoice::whereYear('tanggal', $year)
                ->whereMonth('tanggal', $m)
                ->where('status_pembayaran', 'belum_lunas')
                ->count();
        }

        $totalInvoice = array_sum($monthlyPaid) + array_sum($monthlyUnpaid);
        $paidPercent = $totalInvoice
            ? round((array_sum($monthlyPaid) / $totalInvoice) * 100)
            : 0;

        $totalInvoiceMonth = Invoice::whereMonth('tanggal', Carbon::now()->month)
            ->whereYear('tanggal', Carbon::now()->year)
            ->count();

        $totalPaidInvoice = Invoice::where('status_pembayaran', 'lunas')->count();

        $totalAdminSwq = User::role('admin_swq')->count();
        $totalAdminSby = User::role('admin_sby')->count();

        $revenue = Invoice::select(
            DB::raw('MONTH(tanggal) as month'),
            DB::raw('SUM(total) as total')
        )
            ->whereYear('tanggal', $year)
            ->groupBy(DB::raw('MONTH(tanggal)'))
            ->orderBy('month')
            ->get();

        $monthlyRevenue = collect(range(1, 12))->map(function ($month) use ($revenue) {
            $data = $revenue->firstWhere('month', $month);
            return $data ? (float) $data->total : 0;
        });

        $totalRevenueYear = $monthlyRevenue->sum();

        $totalPendapatan = Invoice::sum('total');
        $totalBelumLunas = Invoice::where('status_pembayaran', 'belum_lunas')->sum('total');
        $totalLunas = Invoice::where('status_pembayaran', 'lunas')->sum('total');

        // Grafik bulanan (12 bulan)
        $months = collect(range(1, 12))->map(
            fn($m) =>
            Carbon::create()->month($m)->format('M')
        );

        $pendapatanBulanan = [];
        $lunasBulanan = [];
        $belumLunasBulanan = [];

        foreach (range(1, 12) as $month) {
            $pendapatanBulanan[] = Invoice::whereMonth('tanggal', $month)->sum('total');

            $lunasBulanan[] = Invoice::whereMonth('tanggal', $month)
                ->where('status_pembayaran', 'lunas')
                ->sum('total');

            $belumLunasBulanan[] = Invoice::whereMonth('tanggal', $month)
                ->where('status_pembayaran', 'belum_lunas')
                ->sum('total');
        }

        return view('pages.dashboard', compact(
            'todayInvoiceTotal',
            'monthlyPaid',
            'monthlyUnpaid',
            'paidPercent',
            'year',
            'totalInvoiceMonth',
            'totalPaidInvoice',
            'totalAdminSwq',
            'totalAdminSby',
            'monthlyRevenue',
            'totalRevenueYear',
            'totalPendapatan',
            'totalBelumLunas',
            'totalLunas',
            'months',
            'pendapatanBulanan',
            'lunasBulanan',
            'belumLunasBulanan'
        ));
    }

    public function locale(Request $request): RedirectResponse
    {
        $locale = $request->query('locale');
        if (in_array($locale, array_keys(config('app.available_locales')))) {
            $request->user()->update(['locale' => $locale]);
            session(['locale' => $locale]);
            App::setLocale($locale);
        } else {
            return back()->with('notification', ['icon' => 'error', 'title' => __('menu.locale'), 'message' => __('notification.locale_not_available')]);
        }

        return back()->with('notification', ['icon' => 'success', 'title' => __('menu.locale'), 'message' => __('notification.locale_success')]);
    }
}

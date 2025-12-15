@extends('layouts.dashboard')

@section('content')
<div class="row">
  <div class="col-lg-8 mb-4 order-0">
    <div class="card">
      <div class="d-flex align-items-end row">
        <div class="col-sm-7">
          <div class="card-body">
            <h5 class="card-title text-primary">
              {{ __('dashboard.welcome_title', ['name' => auth()->user()->name]) }} 🎉
            </h5>

            <p class="mb-4">
              {{ __('dashboard.welcome_desc') }}
              <span class="fw-medium">
                {{ __('dashboard.invoice_today', ['total' => $todayInvoiceTotal ?? 0]) }}
              </span>
            </p>

            <a href="{{ route('invoice.index') }}" class="btn btn-sm btn-outline-primary">
              {{ __('dashboard.view_invoice') }}
            </a>
          </div>
        </div>

        <div class="col-sm-5 text-center text-sm-left">
          <div class="card-body pb-0 px-0 px-md-4">
            <img src="{{ asset('assets/img/illustrations/man-with-laptop-light.png') }}"
              height="140"
              alt="Dashboard Illustration"
              data-app-dark-img="illustrations/man-with-laptop-dark.png"
              data-app-light-img="illustrations/man-with-laptop-light.png">
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-4 col-md-4 order-1">
    <div class="row">
      <div class="col-lg-6 col-md-12 col-6 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <img src="{{asset('assets/img/icons/unicons/invoice.svg')}}" alt="chart success" class="rounded">
              </div>
              <div class="dropdown">
                <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                  <a class="dropdown-item" href="javascript:void(0);">View More</a>
                  <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                </div>
              </div>
            </div>
            <span class="fw-semibold d-block mb-1">
        {{ __('dashboard.total_invoice_month') }}
      </span>
            <h3 class="card-title mb-2">
        {{ $totalInvoiceMonth }}
      </h3>
            <small class="text-muted">
        {{ __('dashboard.this_month') }}
      </small>
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-md-12 col-6 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <img src="{{asset('assets/img/icons/unicons/bill.svg')}}" alt="Credit Card" class="rounded">
              </div>
              <div class="dropdown">
                <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                  <a class="dropdown-item" href="javascript:void(0);">View More</a>
                  <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                </div>
              </div>
            </div>
            <span class="fw-semibold d-block mb-1">
        {{ __('dashboard.invoice_paid') }}
      </span>

      <h3 class="card-title mb-2">
        {{ $totalPaidInvoice }}
      </h3>

      <small class="text-success fw-medium">
        {{ __('dashboard.invoice_paid_desc') }}
      </small>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Total Revenue -->
  <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
    <div class="card">
      <div class="row row-bordered g-0">

        {{-- GRAFIK INVOICE BULANAN --}}
        <div class="col-md-8">
          <h5 class="card-header m-0 me-2 pb-3">
            {{ __('dashboard.invoice_statistics') }}
          </h5>
          <div id="invoiceChart" class="px-2"></div>
        </div>

        {{-- RINGKASAN STATUS --}}
        <div class="col-md-4">
          <div class="card-body">
            <div class="text-center">
              <div class="dropdown">
                <button class="btn btn-sm btn-outline-primary dropdown-toggle"
                  type="button"
                  data-bs-toggle="dropdown">
                  {{ $year }}
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                  @for($y = now()->year; $y >= now()->year - 4; $y--)
                  <a class="dropdown-item" href="?year={{ $y }}">{{ $y }}</a>
                  @endfor
                </div>
              </div>
            </div>
          </div>

          {{-- RADIAL STATUS --}}
          <div id="invoiceStatusChart"></div>

          <div class="text-center fw-medium pt-3 mb-2">
            {{ __('dashboard.invoice_paid_percentage', ['percent' => $paidPercent]) }}
          </div>

          {{-- RINGKASAN ANGKA --}}
          <div class="d-flex px-4 p-4 justify-content-between">
            <div class="d-flex">
              <div class="me-2">
                <span class="badge bg-label-success p-2">
                  <i class="bx bx-check-circle text-success"></i>
                </span>
              </div>
              <div class="d-flex flex-column">
                <small>{{ __('dashboard.paid_invoice') }}</small>
                <h6 class="mb-0">{{ array_sum($monthlyPaid) }}</h6>
              </div>
            </div>

            <div class="d-flex">
              <div class="me-2">
                <span class="badge bg-label-warning p-2">
                  <i class="bx bx-time text-warning"></i>
                </span>
              </div>
              <div class="d-flex flex-column">
                <small>{{ __('dashboard.unpaid_invoice') }}</small>
                <h6 class="mb-0">{{ array_sum($monthlyUnpaid) }}</h6>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

  <!--/ Total Revenue -->
  <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
    <div class="row">
      <div class="col-6 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <img src="{{asset('assets/img/icons/unicons/users-alt.svg')}}" alt="Credit Card" class="rounded">
              </div>
              <div class="dropdown">
                <button class="btn p-0" type="button" id="cardOpt4" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                  <a class="dropdown-item" href="javascript:void(0);">View More</a>
                  <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                </div>
              </div>
            </div>
            <span class="fw-semibold d-block mb-1">
    {{ __('dashboard.total_admin_swq') }}
</span>

<h3 class="card-title text-nowrap mb-2">
    {{ number_format($totalAdminSwq, 0, ',', '.') }}
</h3>

<small class="text-muted fw-medium">
    {{ __('dashboard.invoice_from_swq') }}
</small>
          </div>
        </div>
      </div>
      <div class="col-6 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <img src="{{asset('assets/img/icons/unicons/users-alt.svg')}}" alt="Credit Card" class="rounded">
              </div>
              <div class="dropdown">
                <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="cardOpt1">
                  <a class="dropdown-item" href="javascript:void(0);">View More</a>
                  <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                </div>
              </div>
            </div>
            <span class="fw-semibold d-block mb-1">
    {{ __('dashboard.total_admin_sby') }}
</span>

<h3 class="card-title mb-2">
    {{ number_format($totalAdminSby, 0, ',', '.') }}
</h3>

<small class="text-muted fw-medium">
    {{ __('dashboard.invoice_from_sby') }}
</small>
          </div>
        </div>
      </div>
      <!-- </div>
      <div class="row"> -->
      
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12 col-lg-12 mb-4">
    <div class="card h-100">

      {{-- HEADER TAB --}}
      <div class="card-header">
        <ul class="nav nav-pills" role="tablist">
          <li class="nav-item">
            <button class="nav-link active"
              data-bs-toggle="tab"
              data-bs-target="#tab-total"
              type="button">
              Total Pendapatan
            </button>
          </li>
          <li class="nav-item">
            <button class="nav-link"
              data-bs-toggle="tab"
              data-bs-target="#tab-belum"
              type="button">
              Belum Lunas
            </button>
          </li>
          <li class="nav-item">
            <button class="nav-link"
              data-bs-toggle="tab"
              data-bs-target="#tab-lunas"
              type="button">
              Lunas
            </button>
          </li>
        </ul>
      </div>

      {{-- CONTENT --}}
      <div class="card-body px-0">
        <div class="tab-content p-0">

          {{-- TOTAL PENDAPATAN --}}
          <div class="tab-pane fade show active" id="tab-total">
            <div class="d-flex p-4">
              <span class="badge bg-label-primary p-3 me-3">
                <i class="bx bx-wallet fs-4"></i>
              </span>
              <div>
                <small class="text-muted">Total Pendapatan</small>
                <h4 class="mb-0 text-primary">
                  Rp {{ number_format($totalPendapatan,0,',','.') }}
                </h4>
              </div>
            </div>

            <div class="px-4 pb-4">
              <div id="chartTotal"></div>
            </div>
          </div>

          {{-- BELUM LUNAS --}}
          <div class="tab-pane fade" id="tab-belum">
            <div class="d-flex p-4">
              <span class="badge bg-label-danger p-3 me-3">
                <i class="bx bx-time fs-4"></i>
              </span>
              <div>
                <small class="text-muted">Invoice Belum Lunas</small>
                <h4 class="mb-0 text-danger">
                  Rp {{ number_format($totalBelumLunas,0,',','.') }}
                </h4>
              </div>
            </div>

            <div class="px-4 pb-4">
              <div id="chartBelumLunas"></div>
            </div>
          </div>

          {{-- LUNAS --}}
          <div class="tab-pane fade" id="tab-lunas">
            <div class="d-flex p-4">
              <span class="badge bg-label-success p-3 me-3">
                <i class="bx bx-check-circle fs-4"></i>
              </span>
              <div>
                <small class="text-muted">Invoice Lunas</small>
                <h4 class="mb-0 text-success">
                  Rp {{ number_format($totalLunas,0,',','.') }}
                </h4>
              </div>
            </div>

            <div class="px-4 pb-4">
              <div id="chartLunas"></div>
            </div>
          </div>

        </div>
      </div>

    </div>
  </div>
</div>

@endsection

@push('style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
@endpush

@push('script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
<script>
new ApexCharts(document.querySelector("#invoiceStatusChart"), {
    chart: {
        type: 'radialBar',
        height: 200
    },
    series: [{{ $paidPercent }}],
    labels: ['{{ __("dashboard.paid_invoice") }}'],
    colors: ['#28c76f'],
    plotOptions: {
        radialBar: {
            hollow: { size: '65%' },
            dataLabels: {
                value: {
                    formatter: val => val + '%'
                }
            }
        }
    }
}).render();
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    new ApexCharts(document.querySelector("#invoiceChart"), {
        chart: {
            type: 'bar',
            height: 300,
            toolbar: { show: false }
        },
        series: [
            {
                name: '{{ __("dashboard.paid_invoice") }}',
                data: @json($monthlyPaid)
            },
            {
                name: '{{ __("dashboard.unpaid_invoice") }}',
                data: @json($monthlyUnpaid)
            }
        ],
        colors: ['#28c76f', '#ff9f43'],
        plotOptions: {
            bar: {
                borderRadius: 6,
                columnWidth: '45%'
            }
        },
        xaxis: {
            categories: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des']
        }
    }).render();
});
</script>
<script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    // ===============================
    // DATA DARI CONTROLLER
    // ===============================
    const dataTotal = @json($pendapatanBulanan);
    const dataLunas = @json($lunasBulanan);
    const dataBelum = @json($belumLunasBulanan);

    let activeChart = null;

    function renderChart(selector, series) {
        const el = document.querySelector(selector);
        if (!el) return;

        if (activeChart) {
            activeChart.destroy();
        }

        activeChart = new ApexCharts(el, {
            chart: {
                type: 'area',
                height: 300,
                toolbar: { show: false }
            },
            series: series,
            xaxis: {
                categories: [
                    'Jan','Feb','Mar','Apr','Mei','Jun',
                    'Jul','Agu','Sep','Okt','Nov','Des'
                ]
            },
            colors: ['#696cff', '#71dd37', '#ff3e1d'],
            stroke: {
                curve: 'smooth',
                width: 3
            },
            fill: {
                type: 'gradient',
                gradient: {
                    opacityFrom: 0.5,
                    opacityTo: 0.15
                }
            },
            dataLabels: { enabled: false },
            tooltip: {
                y: {
                    formatter: val =>
                        'Rp ' + new Intl.NumberFormat('id-ID').format(val)
                }
            },
            legend: {
                position: 'top',
                horizontalAlign: 'left'
            }
        });

        activeChart.render();
    }

    // ===============================
    // RENDER DEFAULT (TAB TOTAL)
    // ===============================
    renderChart('#chartTotal', [
        { name: 'Total Pendapatan', data: dataTotal }
    ]);

    // ===============================
    // EVENT TAB BOOTSTRAP
    // ===============================
    document.querySelectorAll('[data-bs-toggle="tab"]').forEach(tab => {
        tab.addEventListener('shown.bs.tab', function (e) {

            if (e.target.dataset.bsTarget === '#tab-total') {
                renderChart('#chartTotal', [
                    { name: 'Total Pendapatan', data: dataTotal }
                ]);
            }

            if (e.target.dataset.bsTarget === '#tab-belum') {
                renderChart('#chartBelumLunas', [
                    { name: 'Invoice Belum Lunas', data: dataBelum }
                ]);
            }

            if (e.target.dataset.bsTarget === '#tab-lunas') {
                renderChart('#chartLunas', [
                    { name: 'Invoice Lunas', data: dataLunas }
                ]);
            }
        });
    });

});
</script>
@endpush
@extends('layouts.dashboard')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h5>{{ __('menu.financial_report') }}</h5>
    </div>

    <div class="card-body border-bottom">
        <form method="GET" class="row g-3 align-items-end">

            {{-- SEARCH --}}
            <div class="col-md-3">
                <label class="form-label">{{ __('label.search') }}</label>
                <input
                    type="text"
                    name="q"
                    class="form-control"
                    placeholder="Search invoice / customer"
                    value="{{ request('q') }}">
            </div>

            {{-- START DATE --}}
            <div class="col-md-3">
                <label class="form-label">{{ __('field.start_date') }}</label>
                <input
                    type="date"
                    name="start_date"
                    class="form-control"
                    value="{{ request('start_date') }}">
            </div>

            {{-- END DATE --}}
            <div class="col-md-3">
                <label class="form-label">{{ __('field.end_date') }}</label>
                <input
                    type="date"
                    name="end_date"
                    class="form-control"
                    value="{{ request('end_date') }}">
            </div>

            {{-- STATUS --}}
            <div class="col-md-2">
                <label class="form-label">Status</label>
                <select name="status" class="form-control">
                    <option value="">All</option>
                    <option value="lunas" {{ request('status')=='lunas'?'selected':'' }}>Paid</option>
                    <option value="belum_lunas" {{ request('status')=='belum_lunas'?'selected':'' }}>Unpaid</option>
                </select>
            </div>

            {{-- BUTTON --}}
            <div class="col-md-3 d-flex gap-2">

                <button type="submit" class="btn btn-primary w-100">
                    Filter
                </button>

                <a href="{{ route('laporan.index') }}"
                    class="btn btn-outline-secondary w-100">
                    Reset
                </a>

                <a href="{{ route('laporan.export', request()->query()) }}"
                    class="btn btn-success w-100">
                    Export
                </a>

            </div>

        </form>
    </div>


    <div class="table-responsive text-nowrap">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>{{ __('field.invoice_number') }}</th>
                    <th>{{ __('field.tanggal') }}</th>
                    <th>{{ __('field.customer') }}</th>
                    <th>{{ __('field.kota_tujuan') }}</th>
                    <th>{{ __('field.total') }}</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                @forelse($items as $item)
                <tr>
                    <td>
                        <a href="{{ route('invoice.show', $item->id) }}">
                            {{ $item->invoice_number }}
                        </a>
                    </td>

                    <td>
                        {{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}
                    </td>

                    <td>
                        {{ $item->customer->nama_toko }}
                    </td>

                    <td>
                        {{ $item->kota_tujuan }}
                    </td>

                    <td>
                        Rp {{ number_format($item->total, 0, ',', '.') }}
                    </td>

                    <td>
                        @if($item->status_pembayaran == 'lunas')
                        <span class="badge bg-success">Lunas</span>
                        @else
                        <span class="badge bg-danger">Belum Lunas</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">
                        Tidak ada data
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="card-body d-flex justify-content-between align-items-center">
        <small class="text-muted">
            Showing {{ $items->firstItem() }} to {{ $items->lastItem() }}
            of {{ $items->total() }} entries
        </small>

        {{ $items->links() }}
    </div>
</div>
@endsection
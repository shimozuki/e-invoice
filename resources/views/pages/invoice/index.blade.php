@extends('layouts.dashboard')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h5>{{ __('menu.invoice') }}</h5>
        <div>
            @can('create_invoice')
            <a href="{{ route('invoice.create') }}"
                class="btn btn-primary">
                {{ __('button.new_feature', ['feature' => __('menu.invoice')]) }}
            </a>
            @endcan
        </div>
    </div>

    <div class="card-body border-bottom">
        <form method="GET" class="row g-3 align-items-end">

            {{-- SEARCH --}}
            <div class="col-md-2">
                <label class="form-label">{{ __('label.search') }}</label>
                <input
                    type="text"
                    name="q"
                    class="form-control"
                    placeholder="{{ __('label.search_invoice') }}"
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

            {{-- BUTTON --}}
            <div class="col-md-4 d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    {{ __('button.filter') }}
                </button>

                <a href="{{ route('invoice.index') }}"
                    class="btn btn-outline-secondary">
                    {{ __('button.reset') }}
                </a>
            </div>

        </form>
    </div>


    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>{{ __('field.invoice_number') }}</th>
                    <th>{{ __('field.tanggal') }}</th>
                    <th>{{ __('field.customer') }}</th>
                    <th>{{ __('field.penerima') }}</th>
                    <th>{{ __('field.kota_tujuan') }}</th>
                    <th>{{ __('field.total') }}</th>
                    <th style="width: 50px"></th>
                </tr>
            </thead>

            <tbody class="table-border-bottom-0">
                @foreach($items as $item)
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
                        {{ $item->pengirim }}
                    </td>

                    <td>
                        {{ $item->kota_tujuan }}
                    </td>

                    <td>
                        Rp {{ number_format($item->total, 0, ',', '.') }}
                    </td>

                    <td>
                        @canany(['edit_invoice', 'delete_invoice'])
                        <div class="dropdown">
                            <button type="button"
                                class="btn p-0 dropdown-toggle hide-arrow"
                                data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>

                            <div class="dropdown-menu">
                                @can('edit_invoice')
                                <a class="dropdown-item"
                                    href="{{ route('invoice.edit', $item->id) }}">
                                    <i class="bx bx-edit-alt me-1"></i>
                                    {{ __('button.edit') }}
                                </a>
                                @endcan

                                @can('delete_invoice')
                                <form action="{{ route('invoice.destroy', $item->id) }}"
                                    method="POST"
                                    class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button class="dropdown-item" type="submit">
                                        <i class="bx bx-trash me-1"></i>
                                        {{ __('button.delete') }}
                                    </button>
                                </form>
                                @endcan
                            </div>
                        </div>
                        @endcanany
                    </td>
                </tr>
                @endforeach
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
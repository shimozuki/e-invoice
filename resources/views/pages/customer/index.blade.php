@extends('layouts.dashboard')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h5>{{ __('menu.customer') }}</h5>
        <div>
            @can('create_customer')
            <a href="{{ route('customer.create') }}"
                class="btn btn-primary">
                {{ __('button.new_feature', ['feature' => __('menu.customer')]) }}
            </a>
            @endcan
        </div>
    </div>
    <div class="card-body border-bottom">
        <form method="GET">
            <div class="row g-2">
                <div class="col-md-4">
                    <input
                        type="text"
                        name="q"
                        value="{{ request('q') }}"
                        class="form-control"
                        placeholder="{{ __('button.search') }}...">
                </div>

                <div class="col-md-2">
                    <button class="btn btn-primary w-100">
                        {{ __('button.search') }}
                    </button>
                </div>

                @if(request('q'))
                <div class="col-md-2">
                    <a href="{{ route('customer.index') }}" class="btn btn-secondary w-100">
                        Reset
                    </a>
                </div>
                @endif
            </div>
        </form>
    </div>

    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>{{ __('field.nama_toko') }}</th>
                    <th>{{ __('field.nama_pemilik') }}</th>
                    <th>{{ __('field.email') }}</th>
                    <th>{{ __('field.telepon') }}</th>
                    <th>{{ __('field.kota') }}</th>
                    <th>{{ __('field.alamat')}}</th>
                    <th style="width: 50px"></th>
                </tr>
            </thead>

            <tbody class="table-border-bottom-0">
                @foreach($items as $item)
                <tr>
                    <td>
                        <a href="{{ route('customer.show', $item->id) }}">
                            {{ $item->nama_toko }}
                        </a>
                    </td>
                    <td>{{ $item->nama_pemilik ?? '-' }}</td>
                    <td>{{ $item->email ?? '-'}}</td>
                    <td>{{ $item->telepon ?? '-' }}</td>
                    <td>{{ $item->kota }}</td>
                    <td>{{ $item->alamat}}</td>
                    <td>
                        @canany(['edit_customer', 'delete_customer'])
                        <div class="dropdown">
                            <button type="button"
                                class="btn p-0 dropdown-toggle hide-arrow"
                                data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>

                            <div class="dropdown-menu">
                                @can('edit_customer')
                                <a class="dropdown-item"
                                    href="{{ route('customer.edit', $item->id) }}">
                                    <i class="bx bx-edit-alt me-1"></i>
                                    {{ __('button.edit') }}
                                </a>
                                @endcan

                                @can('delete_customer')
                                <form action="{{ route('customer.destroy', $item->id) }}"
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

    <div class="card-body">
        {!! $items->links() !!}
    </div>
</div>
@endsection
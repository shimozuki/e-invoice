@extends('layouts.dashboard')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h5>{{ __('menu.customer') }}</h5>
        <div>
            <a href="{{ route('customer.index') }}"
                class="btn btn-outline-secondary">
                {{ __('button.back') }}
            </a>

            @can('edit_customer')
            <a href="{{ route('customer.edit', $customer->id) }}"
                class="btn btn-primary">
                {{ __('button.edit') }}
            </a>
            @endcan
        </div>
    </div>

    <div class="card-body">
        <div class="row">

            <div class="mb-3 col-md-12">
                <label class="form-label">{{ __('field.nama_toko') }}</label>
                <input type="text"
                    class="form-control-plaintext"
                    readonly
                    value="{{ $customer->nama_toko }}">
            </div>

            <div class="mb-3 col-md-12">
                <label class="form-label">{{ __('field.nama_pemilik') }}</label>
                <input type="text"
                    class="form-control-plaintext"
                    readonly
                    value="{{ $customer->nama_pemilik ?? '-' }}">
            </div>

            <div class="mb-3 col-md-12">
                <label class="form-label">{{ __('field.telepon') }}</label>
                <input type="text"
                    class="form-control-plaintext"
                    readonly
                    value="{{ $customer->telepon ?? '-' }}">
            </div>

            <div class="mb-3 col-md-12">
                <label class="form-label">{{ __('field.alamat') }}</label>
                <textarea class="form-control-plaintext" readonly rows="3">
                {{ $customer->alamat }}
                </textarea>
            </div>

            <div class="mb-3 col-md-6">
                <label class="form-label">{{ __('field.kota') }}</label>
                <input type="text"
                    class="form-control-plaintext"
                    readonly
                    value="{{ $customer->kota }}">
            </div>

            <div class="mb-3 col-md-6">
                <label class="form-label">{{ __('field.email') }}</label>
                <input type="text"
                    class="form-control-plaintext"
                    readonly
                    value="{{ $customer->email ?? '-' }}">
            </div>

        </div>
    </div>
</div>
@endsection
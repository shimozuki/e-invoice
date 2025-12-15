@extends('layouts.dashboard')

@section('content')
<div class="card">
    <form action="{{ route('customer.store') }}" method="POST">
        @csrf

        <div class="card-header d-flex justify-content-between">
            <h5>{{ __('menu.customer') }}</h5>
            <div>
                <a href="{{ route('customer.index') }}"
                    class="btn btn-outline-secondary">
                    {{ __('button.back') }}
                </a>
                <button type="submit" class="btn btn-primary">
                    {{ __('button.submit') }}
                </button>
            </div>
        </div>

        <div class="card-body">
            <div class="row">

                <div class="mb-3 col-md-12">
                    <x-forms.input
                        name="nama_toko"
                        :label="__('field.nama_toko')"
                        autofocus />
                </div>

                <div class="mb-3 col-md-12">
                    <x-forms.input
                        name="nama_pemilik"
                        :label="__('field.nama_pemilik')" />
                </div>

                <div class="mb-3 col-md-12">
                    <x-forms.input
                        name="telepon"
                        :label="__('field.telepon')" />
                </div>

                <div class="mb-3 col-md-12">
                    <x-forms.input-textarea
                        name="alamat"
                        :label="__('field.alamat')" />
                </div>

                <div class="mb-3 col-md-6">
                    <x-forms.input
                        name="kota"
                        :label="__('field.kota')" />
                </div>

                <div class="mb-3 col-md-6">
                    <x-forms.input
                        name="email"
                        type="email"
                        :label="__('field.email')" />
                </div>

            </div>
        </div>
    </form>
</div>
@endsection
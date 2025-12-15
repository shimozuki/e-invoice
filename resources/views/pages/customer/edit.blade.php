@extends('layouts.dashboard')

@section('content')
<div class="card">
    <form action="{{ route('customer.update', $customer->id) }}" method="POST">
        @method('PATCH')
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
                        autofocus
                        :value="$customer->nama_toko" />
                </div>

                <div class="mb-3 col-md-12">
                    <x-forms.input
                        name="nama_pemilik"
                        :value="$customer->nama_pemilik" />
                </div>

                <div class="mb-3 col-md-12">
                    <x-forms.input
                        name="telepon"
                        :value="$customer->telepon" />
                </div>

                <div class="mb-3 col-md-12">
                    <x-forms.input-textarea
                        name="alamat"
                        :value="$customer->alamat" />
                </div>

                <div class="mb-3 col-md-6">
                    <x-forms.input
                        name="kota"
                        :value="$customer->kota" />
                </div>

                <div class="mb-3 col-md-6">
                    <x-forms.input
                        name="email"
                        type="email"
                        :value="$customer->email" />
                </div>

            </div>
        </div>
    </form>
</div>
@endsection
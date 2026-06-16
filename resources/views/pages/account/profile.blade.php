@extends('layouts.dashboard')

@section('content')
<h4 class="py-3 mb-4">
    <span class="text-muted fw-light">{{ __('menu.account') }} /</span> {{ __('menu.profile') }}
</h4>

<div class="row">
    <div class="col-md-12">
        <ul class="nav nav-pills flex-column flex-md-row mb-3">
            <li class="nav-item">
                <a class="nav-link active" href="javascript:void(0);">
                    <i class="bx bx-user me-1"></i> {{ __('menu.profile') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('account.password.edit') }}">
                    <i class="bx bx-lock-open-alt me-1"></i> {{ __('menu.change_password') }}
                </a>
            </li>
        </ul>
        <div class="card mb-4">
            <h5 class="card-header">{{ __('label.profile_information') }}</h5>
            <!-- Account -->
            <div class="card-body">
                <form id="formAccountSettings" action="{{ route('account.profile.update') }}" method="POST">
                    @csrf
                    @method('patch')
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <x-forms.input name="name" :value="$user->name" />
                        </div>
                        <div class="mb-3 col-md-6">
                            <x-forms.input name="email" type="email" :value="$user->email" />
                        </div>
                    </div>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary me-2">{{ __('button.submit') }}</button>
                    </div>
                </form>
            </div>
            <!-- /Account -->
        </div>
        <div class="card mb-4">
            <!-- Account -->
            <form action="{{ route('password.update') }}" method="POST">
                @csrf
                @method('put')
                <div class="card-body">
                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <x-forms.input-password name="current_password" />
                        </div>
                        <div class="mb-3 col-md-12">
                            <x-forms.input-password name="password" />
                        </div>
                        <div class="mb-3 col-md-12">
                            <x-forms.input-password name="password_confirmation" />
                        </div>
                    </div>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary me-2">{{ __('button.submit') }}</button>
                        <button type="reset" class="btn btn-outline-secondary">{{ __('button.reset') }}</button>
                    </div>
                </div>
            </form>
            <!-- /Account -->
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    const checkBox = $('#accountActivation');
    const accountActivationButton = $('#accountActivationButton');

    $('#password').on('keyup', function(e) {
        checkBox.attr("disabled", e.target.value.length === 0);
    });

    checkBox.on('change', function(e) {
        accountActivationButton.attr('disabled', !checkBox.prop('checked'));
    })

    console.log($('#accountActivation'));
</script>
@endpush
@extends('layouts.dashboard')

@section('content')
<h4 class="py-3 mb-4">
    <span class="text-muted fw-light">{{ __('menu.account') }} /</span> {{ __('menu.delete_account') }}
</h4>

<div class="row">
    <div class="col-md-12">
        <ul class="nav nav-pills flex-column flex-md-row mb-3">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('account.profile.edit') }}">
                    <i class="bx bx-user me-1"></i> {{ __('menu.profile') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="javascript:void(0);">
                    <i class="bx bx-lock-open-alt me-1"></i> {{ __('menu.delete_account') }}
                </a>
            </li>
        </ul>
        <div class="card">
            <h5 class="card-header">{{ __('label.delete_account') }}</h5>
            <div class="card-body">
                <div class="mb-3 col-12 mb-0">
                    <div class="alert alert-warning">
                        <h6 class="alert-heading fw-medium mb-1">{{ __('label.are_you_sure_delete_account') }}</h6>
                        <p class="mb-0">{{ __('label.once_your_account_deleted') }}</p>
                    </div>
                </div>
                <form id="formAccountDeactivation" method="post" action="{{ route('account.profile.destroy') }}">
                    @csrf
                    @method('delete')
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <x-forms.input-password name="password" />
                        </div>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" disabled type="checkbox" name="accountActivation"
                            id="accountActivation" />
                        <label class="form-check-label"
                            for="accountActivation">{{ __('label.im_sure_delete_account') }}</label>
                    </div>
                    <button type="submit" disabled class="btn btn-danger deactivate-account"
                        id="accountActivationButton">{{ __('button.delete_permanently') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
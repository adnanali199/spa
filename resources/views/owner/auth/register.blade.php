@extends('frontend.layouts.app')

@section('content')
<div class="login-page">
    <div class=" my-5">
<div class="register-box  mx-auto mt-5 pt-5">
    <div class="card">
    <div class="card-body">
        <h3 class="login-box-msg text-center">{{ __('Owner Register') }}</h3>

        <form method="POST" action="{{ route('owner.registeraction') }}">
            @csrf

            <div class="input-group mb-3">
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                       placeholder="{{ __('Owner Name') }}" required autocomplete="name"
                       value="{{    old('name') }}" autofocus>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user"></span>
                    </div>
                </div>
                @error('name')
                <span class="error invalid-feedback">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="input-group mb-3">
                <input type="phone" name="phone" class="form-control @error('phone') is-invalid @enderror"
                       placeholder="{{ __('Phone') }}"
                       value="{{    old('phone') }}" 
                       required autocomplete="phone" autofocus>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-phone"></span>
                    </div>
                </div>
                @error('phone')
                <span class="error invalid-feedback">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="input-group mb-3">
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                       placeholder="{{ __('Email') }}"
                       value="{{    old('email') }}"  autocomplete="email">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
                @error('email')
                <span class="error invalid-feedback">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="input-group mb-3">
                <input type="text" name="cpr" class="form-control @error('cpr') is-invalid @enderror"
                       placeholder="{{ __('CPR') }}" 
                       value="{{    old('cpr') }}" required autocomplete="cpr" autofocus>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-id-card"></span>
                    </div>
                </div>
                @error('cpr')
                <span class="error invalid-feedback">
                    {{ $message }}
                </span>
                @enderror
            </div>
            
            <div class="input-group mb-3">
                <input type="text" name="iban" class="form-control @error('iban') is-invalid @enderror"
                       placeholder="{{ __('IBAN') }}" 
                       value="{{    old('iban') }}" required autocomplete="iban">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-credit-card"></span>
                    </div>
                </div>
                @error('iban')
                <span class="error invalid-feedback">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="input-group mb-3">
                <input type="text" name="contract_no" class="form-control @error('contract_no') is-invalid @enderror"
                       placeholder="{{ __('Contract No.') }}"
                       value="{{    old('contract_no') }}"
                        required autocomplete="contract_no">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-file-contract"></span>
                    </div>
                </div>
                @error('contract_no')
                <span class="error invalid-feedback">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class=" mb-3">
                <label>{{__('Address')}}</label>
                <textarea rows="4" cols="20" name="address" class="form-control @error('address') is-invalid @enderror"
                       placeholder="{{ __('Address') }}" required autocomplete="address" autofocus>
                       {{    old('address') }}
                    </textarea>
              
                @error('address')
                <span class="error invalid-feedback">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="input-group mb-3">
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                       placeholder="{{ __('Password') }}" required autocomplete="new-password">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
                @error('password')
                <span class="error invalid-feedback">
                    {{ $message }}
                </span>
                @enderror
            </div>

            <div class="input-group mb-3">
                <input type="password" name="password_confirmation"
                       class="form-control @error('password_confirmation') is-invalid @enderror"
                       placeholder="{{ __('Confirm Password') }}" required autocomplete="new-password">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <button type="submit"
                            class="btn btn-primary btn-block">{{ __('Register') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
    </div></div>
@endsection

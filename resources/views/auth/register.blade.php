@extends('frontend.layouts.app')
@section('styles')
<style>
.login-page{
    width:40%;
    margin:0px auto;
}
@media screen and (max-width:960px)
{
    .login-page{
    width:100%;
    margin:0px auto;
}
}
</style>
@endsection
@section('content')
<div class="login-page">
    <div class=" my-5">
<div class="login-box m-auto">
<div class="card">
    <div class="card-body login-card-body">
        <h3 class="login-box-msg text-center">{{ __('Register') }}</h3>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="input-group mb-3">
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                       placeholder="{{ __('Name') }}" required autocomplete="name" autofocus value="{{old('name')}}">
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
                       placeholder="{{ __('Phone') }}" required autocomplete="phone" value="{{old('phone')}}" autofocus>
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
                <input type="text" name="cpr" class="form-control @error('cpr') is-invalid @enderror"
                       placeholder="{{ __('cpr') }}" required autocomplete="name" value="{{old('cpr') }}" autofocus>
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
            <div class="input-group mb-3 d-none">
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                       placeholder="{{ __('Email') }}"  autocomplete="email" value="{{ old('email') }}">
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
            
            <div class="input-group mb-3 d-none">
                <input type="phone" name="an_other" class="form-control @error('an_other') is-invalid @enderror"
                       placeholder="{{ __('An Other Contact') }}" value="{{ old('an_other') }}" autocomplete="an_other" autofocus>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-phone"></span>
                    </div>
                </div>
                @error('an_other')
                <span class="error invalid-feedback">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="input-group mb-3 d-none">
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                       placeholder="{{ __('Password') }}"  autocomplete="new-password">
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

            <div class="input-group mb-3 d-none">
                <input type="password" name="password_confirmation"
                       class="form-control @error('password_confirmation') is-invalid @enderror"
                       placeholder="{{ __('Confirm Password') }}"  autocomplete="new-password">
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
    </div>
</div>
@endsection

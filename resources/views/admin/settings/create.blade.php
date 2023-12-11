@extends('layouts.admin')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6 col-md-12">
                <h4 class="m-0"><i class="fa fa-plus"></i>
                {{ __('Settings') }}
                     </h4>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
              <div class="text-right">
              
              </div>
                <div class="alert alert-info d-none">
                 {{__('New Booking')}}
                </div>
                <div class="row">
             
                
             <div class="col-md-12">
                <div class="card">
                    <div class="card-body p-5">
                        <form method="POST" action="{{ route('admin.settingsaction') }}" enctype="multipart/form-data">
                            @csrf
                            
                            
                            
                            <div class="mb-3">
                                <label>Website Name</label>
                                
                                <input type="text" name="name" id="website_name" class="mt-3 form-control @error('name') is-invalid @enderror"
                                
                                value="{{    ($settings)?$settings->name:old('name') }}"
                                  placeholder="Website Name" value="" >
                               
                                @error('name')
                                <span class="error invalid-feedback">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                          
                          
                            <div class="mb-3">
                                <label>contact_no </label>
                                <input type="text"  name="contact_no" id="contact_no" class="form-control @error('contact_no') is-invalid @enderror"
                                       placeholder="{{ __('Contact No') }}"
                                       value="{{    ($settings)?$settings->contact_no:old('contact_no') }}"
                                       required autocomplete="contact_no" autofocus>
                               
                                @error('contact_no')
                                <span class="error invalid-feedback">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            
                            <div class="mb-3 row">
                                <div class="col-md-6">
                                <label>Email</label>
                                <input type="email"  name="email" id="email" class="form-control @error('email') is-invalid @enderror"
                                       placeholder="{{ __('Email') }}"
                                       value="{{    ($settings)?$settings->email:old('email') }}"
                                       required autocomplete="email" autofocus>
                               
                                @error('email')
                                <span class="error invalid-feedback">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                               
                                <label for="" class="form__label">IBAN</label>
                                        <input type="text" name="iban" class="form-control" placeholder="IBAN "
                                        value="{{    ($settings)?$settings->iban:old('iban') }}"
                                        class="form-control @error('iban') is-invalid @enderror"
                                        >
                                        
                                        @error('iban')
                                        <span class="error invalid-feedback">
                                            {{ $message }}
                                        </span>
                                        @enderror
                               
                            </div>
                            
                            <div class="col-md-6">
                                <label>Logo</label>
                                <div class="input-group">
                                  
                                <input type="file" name="logo" multiple class="form-control @error('logo') is-invalid @enderror">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-image"></span>
                                    </div>
                                </div>
                            </div>
                                @error('logo')
                                <span class="error invalid-feedback">
                                    {{ $message }}
                                </span>
                                @enderror
                        </div>
                        <div class="col-md-6 mt-3 text-center mb-3">
                            <img src = "{{ asset('uploads/'.$settings->logo) }} " class="thumnail img img-responsive img-circle" width="100px" >
                        </div>

                        

                            </div>
                            <div class="row mb-3">
                                <label>{{__('Address')}}</label>
                                <textarea rows="4" cols="100" name="address" class="form-control @error('address') is-invalid @enderror"
                                       placeholder="{{ __('Address') }}">
                                       {{   ($settings)?$settings->address: old('address') }}
                                    </textarea>
                              
                                @error('address')
                                <span class="error invalid-feedback">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label>Paypal key </label>
                                <input type="text"  name="paypal_key" id="paypal_key" class="form-control @error('paypal_key') is-invalid @enderror"
                                       placeholder="{{ __('Contact No') }}"
                                       value="{{    ($settings)?$settings->paypal_key:old('paypal_key') }}"
                                       >
                               
                                @error('paypal_key')
                                <span class="error invalid-feedback">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label>Stripe key </label>
                                <input type="text"  name="stripe_key" id="stripe_key" class="form-control @error('stripe_key') is-invalid @enderror"
                                       placeholder="{{ __('Contact No') }}"
                                       value="{{    ($settings)?$settings->stripe_key:old('stripe_key') }}"
                                       >
                               
                                @error('stripe_key')
                                <span class="error invalid-feedback">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                           
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label>Facebook Profile </label>
                                <input type="text"  name="facebook"  class="form-control @error('facebook') is-invalid @enderror"
                                       placeholder="{{ __('Facebook') }}"
                                       value="{{    ($settings)?$settings->facebook:old('facebook') }}"
                                      >
                                </div>
                                <div class="col-md-4">
                                    <label>Twitter Profile </label>
                                    <input type="text"  name="twitter"  class="form-control @error('twitter') is-invalid @enderror"
                                           placeholder="{{ __('Twitter') }}"
                                           value="{{    ($settings)?$settings->twitter:old('twitter') }}"
                                          >
                                </div>
                                <div class="col-md-4">
                                    <label>Fax </label>
                                    <input type="text"  name="fax"  class="form-control @error('fax') is-invalid @enderror"
                                           placeholder="{{ __('Fax') }}"
                                           value="{{    ($settings)?$settings->fax:old('fax') }}"
                                          >
                                </div>
                            </div>
                           
                                   
                                       
                           
                
                            <div class="row">
                                <div class="col-12">
                                    <button type="submit"
                                            class="btn btn-primary btn-block">{{ __('Submit') }}</button>
                                </div>
                            </div>
                        </form>
                </div>
                    <!-- /.card-body -->

                    <div class="card-footer clearfix">
                        
                    </div>
                </div>
            
            </div>
        </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
</div>
@endsection
@section('scripts')

<script>
$(document).ready(function(){
   
});




</script>

@endsection
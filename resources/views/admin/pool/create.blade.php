@extends('layouts.owner')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6 col-md-12">
                <h4 class="m-0"><i class="fa fa-plus"></i>
                {{ __('New Pool') }}
                     </h4>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<!-- Main content -->
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
              <div class="text-right">
              
              </div>
                <div class="alert alert-info d-none">
                 {{__('New Pool')}}
                </div>
                <div class="row">
             
                
             <div class="col-md-12">
                <div class="card">
                    <div class="card-body p-5">
                        <form method="POST" action="{{ route('owner.poolaction',$pool->id??0) }}" enctype="multipart/form-data">
                            @csrf
                
                            <div class="mb-3">
                                <label>Pool Name</label>
                                <input type="text" name="pool_name" class="form-control @error('pool_name') is-invalid @enderror"
                                       placeholder="{{ __('Pool Name') }}" required autocomplete="pool_name"
                                       value=" {{    !empty($pool)?$pool->pool_name:old('pool_name') }}" autofocus>
                                
                                @error('pool_name')
                                <span class="error invalid-feedback">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label>Short Name</label>
                                <input type="text" name="short_name" class="form-control @error('short_name') is-invalid @enderror"
                                       placeholder="{{ __('short_name') }}"
                                       value=" {{    ($pool)?$pool->short_name:old('short_name') }}" 
                                       required autocomplete="short_name" autofocus>
                               
                                @error('short_name')
                                <span class="error invalid-feedback">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label>Header Images</label>
                                    <div class="input-group">
                                <input type="file" name="images[]" multiple class="form-control @error('images') is-invalid @enderror">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-image"></span>
                                    </div>
                                </div>
                            </div>
                                @error('images')
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
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-12">Pool Size</label>
                                <hr>
                                <div class="col-md-6">
                                    <label>Length</label>
                                <input type="number" min=0 step=0.1 name="length" class="form-control @error('length') is-invalid @enderror"
                                       placeholder="{{ __('Length') }}"
                                       value={{    ($pool)?$pool->length:old('length') }} 
                                       required autocomplete="length" autofocus>
                               
                                @error('length')
                                <span class="error invalid-feedback">
                                    {{ $message }}
                                </span>
                                @enderror
                                </div>
                                <div class="col-md-6">
                                    <label>Width </label>
                                    <input type="number" min=0 step=0.1 name="width" class="form-control @error('width') is-invalid @enderror"
                                           placeholder="{{ __('Width') }}"
                                           value={{    ($pool)?$pool->width:old('width') }} 
                                           required autocomplete="width" autofocus>
                                   
                                    @error('width')
                                    <span class="error invalid-feedback">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                    </div>

                            </div>
                            <div class="row mb-3">
                                <label class="col-md-12">Land Size</label>
                                <div class="col-md-6">
                                    <label>Length</label>
                                <input type="number" min=0 step=0.1 name="land_length" class="form-control @error('land_length') is-invalid @enderror"
                                       placeholder="{{ __('Length') }}"
                                       value={{    ($pool)?$pool->land_length:old('land_length') }} 
                                       required autocomplete="land_length" autofocus>
                               
                                @error('land_length')
                                <span class="error invalid-feedback">
                                    {{ $message }}
                                </span>
                                @enderror
                                </div>
                                <div class="col-md-6">
                                    <label>Width </label>
                                    <input type="number" min=0 step=0.1 name="land_width" class="form-control @error('land_width') is-invalid @enderror"
                                           placeholder="{{ __('Width') }}"
                                           value={{    ($pool)?$pool->land_width:old('land_width') }} 
                                           required autocomplete="land_width" autofocus>
                                   
                                    @error('land_width')
                                    <span class="error invalid-feedback">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                    </div>

                            </div>
                            <div class="row mb-3">
                              
                                <div class="col-md-12">
                                    <label>No. of Rooms</label>
                                <input type="number" min=0 step=0.1 name="no_of_rooms" class="form-control @error('no_of_rooms') is-invalid @enderror"
                                       placeholder="{{ __('Number of Rooms') }}"
                                       value={{    ($pool)?$pool->no_of_rooms:old('no_of_rooms') }} 
                                       required autocomplete="no_of_rooms" autofocus>
                               
                                @error('no_of_rooms')
                                <span class="error invalid-feedback">
                                    {{ $message }}
                                </span>
                                @enderror
                                </div>
                              

                            </div>
                            <div class="row mb-3">

                                <div class="col-md-6">
                                    <label>Normal Price</label>
                                <input type="number" min=0 step=0.1 name="price" class="form-control @error('price') is-invalid @enderror"
                                       placeholder="{{ __('Normal Price($)') }}"
                                       value={{    ($pool)?$pool->price:old('price') }} 
                                       required autocomplete="price" autofocus>
                               
                                @error('price')
                                <span class="error invalid-feedback">
                                    {{ $message }}
                                </span>
                                @enderror
                                </div>
                                <div class="col-md-6">
                                    <label>Holiday Price </label>
                                    <input type="number" min=0 step=0.1 name="holiday_price" class="form-control @error('holiday_price') is-invalid @enderror"
                                           placeholder="{{ __('Holiday Price($)') }}"
                                           value={{    ($pool)?$pool->holiday_price:old('holiday_price') }} 
                                           required autocomplete="holiday_price" autofocus>
                                   
                                    @error('holiday_price')
                                    <span class="error invalid-feedback">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                    </div>

                            </div>
                            <div class="row mb-3">
                                <label class="col-md-12">Address</label>   
                                <div class="col-md-3">
                                    <label>city</label>
                                <input type="text" name="city" class="form-control @error('city') is-invalid @enderror"
                                       placeholder="{{ __('City') }}"
                                       value='{{    ($pool)?$pool->city:old('city') }}'
                                       required autocomplete="city" autofocus>
                               
                                @error('city')
                                <span class="error invalid-feedback">
                                    {{ $message }}
                                </span>
                                @enderror
                                </div>
                                <div class="col-md-3">
                                    <label>State </label>
                                    <input type="text"  name="state" class="form-control @error('state') is-invalid @enderror"
                                           placeholder="{{ __('State') }}"
                                           value='{{    ($pool)?$pool->state:old('state') }}'
                                           required autocomplete="state" autofocus>
                                   
                                    @error('state')
                                    <span class="error invalid-feedback">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label>Street </label>
                                        <input type="text" name="street" class="form-control @error('street') is-invalid @enderror"
                                               placeholder="{{ __('Street') }}"
                                               value='{{    ($pool)?$pool->state:old('street') }}'
                                               required autocomplete="street" autofocus>
                                       
                                        @error('street')
                                        <span class="error invalid-feedback">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                        </div>

                            </div>
                            <div class=" mb-3">
                                <label class="form-label">{{ __('Features') }}</label>
                                <textarea rows="4" cols="20" name="features" class="form-control @error('features') is-invalid @enderror"
                                       placeholder="{{ __('features') }}" required autocomplete="features" autofocus>
                                       {{    ($pool)?$pool->features:old('features') }}
                                    </textarea>
                              
                                @error('features')
                                <span class="error invalid-feedback">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class=" mb-3">
                                <label class="form-label">{{ __('Rules') }}</label>
                                <textarea rows="4" cols="20" name="rules" class="form-control @error('rules') is-invalid @enderror"
                                       placeholder="{{ __('rules') }}" required autocomplete="rules" autofocus>
                                       {{    ($pool)?$pool->rules:old('rules') }}
                                    </textarea>
                              
                                @error('rules')
                                <span class="error invalid-feedback">
                                    {{ $message }}
                                </span>
                                @enderror
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
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/jquery.tinymce.min.js" referrerpolicy="origin"></script>
<script>
    $('textarea').tinymce({ height: 400,
        
        plugins: [
          'advlist autolink lists link image',
          'insertdatetime media table paste  wordcount'
        ], 
        toolbar: [
            "heading| bold italic | bullist numlist",
            "code"
            ],  });
  </script>
@endsection
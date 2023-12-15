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
             
                
             <div class="">
                <div class="card">
                    <div class="card-body ">
                        <form method="POST" action="{{ route('owner.poolaction',$pool->id??0) }}" enctype="multipart/form-data">
                            @csrf
                
                            <div class="mb-3">
                                <label>{{__("Pool Name") }}</label>
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
                                <label>{{__("Short Name") }}</label>
                                <input type="text" name="short_name" class="form-control @error('short_name') is-invalid @enderror"
                                       placeholder="{{ __('Short Name') }}"
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
                                    <label>{{__('Header Images')}}</label>
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
                                @if($pool && $pool->images)
                                <div class="mt-2">
                                @foreach($pool->images as $image)
                        
                                <img  src=" {{ asset('uploads/'.$image->pool_image) }} " width="150px" class="img img-responsive img-thumbnail">
                                <a style="position: absolute;left:5px;bottom:0px" href="#" data-href="{{ route('owner.pools.deleteimg',$image->id)}}" class="btn btn-sm delete" title="{{ __('delete') }}"><i class="text-danger fa fa-trash fa-2x"></i></a>
                                @endforeach 
                                </div>
                                @endif
                            </div>
                           
                                <div class="col-md-6">
                                    <label>{{ __("Logo") }}</label>
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
                                    @if($pool && $pool->logo)
                                <div class="mt-2">
                                <img src=" {{ asset('uploads/'.$pool->logo) }} " width="100px" class="img img-responsive img-thumbnail">
                              
                                </div>
                                @endif
                            </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-12 py-2 border-bottom bg-info">Pool Features</label>
                                <hr>
                                <div class="col-md-4">
                                    <label>Length</label>
                                <input type="number" min=0 step=0.1 name="length" class="form-control @error('length') is-invalid @enderror"
                                       placeholder="{{ __('Length') }}"
                                       value={{    ($pool)?$pool->length:old('length') }} 
                                        autocomplete="length" autofocus>
                               
                                @error('length')
                                <span class="error invalid-feedback">
                                    {{ $message }}
                                </span>
                                @enderror
                                </div>
                                <div class="col-md-4">
                                    <label>Width </label>
                                    <input type="number" min=0 step=0.1 name="width" class="form-control @error('width') is-invalid @enderror"
                                           placeholder="{{ __('Width') }}"
                                           value={{    ($pool)?$pool->width:old('width') }} 
                                            autocomplete="width" autofocus>
                                   
                                    @error('width')
                                    <span class="error invalid-feedback">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label>Depth</label>
                                    <input type="number" min=0 step=0.1 name="depth" class="form-control @error('depth') is-invalid @enderror"
                                           placeholder="{{ __('Depth') }}"
                                           value={{    ($pool)?$pool->depth:old('depth') }} 
                                            autocomplete="length" autofocus>
                                   
                                    @error('depth')
                                    <span class="error invalid-feedback">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                    </div>

                            </div>

                            <div class="feature mb-2">
                               
                                @if($pool && $features)
                                <?php $i=0;  ?>
                                @foreach($features as $feature)
                                <div class="row">    
                                    <div class="col-md-4 mt-1">
                                        <input type="text" name="feature_title[]" value="{{$feature->feature_title}}" placeholder="{{__('Title')}}" class="form-control">
                                        </div>
                                        <div class="col-md-3 mt-1">
                                        <input type="number" min=0 name="feature_value[]" value="{{$feature->feature_value}}" placeholder="{{__('Value')}}"  class="form-control">
                                        </div>
                                        <div class="col-md-3 mt-1">
                                            <input type="file" name="feature_icon[]" class="form-control">
                                            <img src="{{ asset('icons/'.$feature->feature_icon) }} "  class="mt-2 img img-responsive img-thumbnail" width="50px" >
                                        </div>
                                        <div class="col-md-2 mt-1 text-center">
                                            @if($i==0)
                                            <span class="btn btn-sm btn-success add_feature"><i class="fa fa-plus"> </i></span>
                                            @endif
                                            <span class="btn btn-sm btn-danger remove_feature"><i class="fa fa-trash"> </i></span>
                                        </div>
                                    </div>
                                    @php 
                                    $i++;
                                    @endphp
                                @endforeach
                                @else
                                <div class="row">    
                                <div class="col-md-4 mt-1">
                                    <input type="text" name="feature_title[]" class="form-control">
                                    </div>
                                    <div class="col-md-3 mt-1">
                                    <input type="number" min=0 name="feature_value[]" class="form-control">
                                    </div>
                                    <div class="col-md-3 mt-1">
                                        <input type="file" name="feature_icon[]" class="form-control">
                                    </div>
                                    <div class="col-md-2 mt-1 text-center">
                                        <span class="btn btn-sm btn-success add_feature"><i class="fa fa-plus"> </i></span>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <!--
                            <div class="row mb-3">
                                
                                    

                                <div class="col-md-4">
                                    <label>Anteroom</label>
                                <input type="number" min=0 step=1 name="anteroom" class="form-control @error('anteroom') is-invalid @enderror"
                                       placeholder="{{ __('anteroom') }}"
                                       value={{    ($pool)?$pool->anteroom:old('anteroom') }} 
                                        autocomplete="anteroom" >
                               
                                @error('anteroom')
                                <span class="error invalid-feedback">
                                    {{ $message }}
                                </span>
                                @enderror
                                </div>
                                <div class="col-md-4">
                                    <label>Bathrooms </label>
                                    <input type="number" min=0 step=1 name="bathroom" class="form-control @error('bathroom') is-invalid @enderror"
                                           placeholder="{{ __('bathroom') }}"
                                           value={{    ($pool)?$pool->bathroom:old('bathroom') }} 
                                            autocomplete="bathroom" >
                                   
                                    @error('bathroom')
                                    <span class="error invalid-feedback">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label>Shower</label>
                                    <input type="number" min=0 step=1 name="shower" class="form-control @error('shower') is-invalid @enderror"
                                           placeholder="{{ __('shower') }}"
                                           value={{    ($pool)?$pool->shower:old('shower') }} 
                                            autocomplete="length" >
                                   
                                    @error('shower')
                                    <span class="error invalid-feedback">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label>BBQ</label>
                                    <input type="number" min=0 step=1 name="bbq" class="form-control @error('bbq') is-invalid @enderror"
                                           placeholder="{{ __('bbq') }}"
                                           value={{    ($pool)?$pool->bbq:old('bbq') }} 
                                            autocomplete="length" >
                                   
                                    @error('bbq')
                                    <span class="error invalid-feedback">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label>Bedrooms</label>
                                    <input type="number" min=0 step=1 name="bedrooms" class="form-control @error('bedrooms') is-invalid @enderror"
                                           placeholder="{{ __('bedrooms') }}"
                                           value={{    ($pool)?$pool->bedroom:old('bedrooms') }} 
                                            autocomplete="length" >
                                   
                                    @error('bedrooms')
                                    <span class="error invalid-feedback">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label>Guests Allowed</label>
                                    <input type="number" min=0 step=1 name="guests_allowed" class="form-control @error('guests_allowed') is-invalid @enderror"
                                           placeholder="{{ __('guests_allowed') }}"
                                           value={{    ($pool)?$pool->guests_allowed:old('guests_allowed') }} 
                                            autocomplete="length" >
                                   
                                    @error('guests_allowed')
                                    <span class="error invalid-feedback">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label>Kids Games</label>
                                    <input type="number" min=0 step=1 name="kids_games" class="form-control @error('kids_games') is-invalid @enderror"
                                           placeholder="{{ __('kids_games') }}"
                                           value={{    ($pool)?$pool->kids_games:old('kids_games') }} 
                                            autocomplete="length" >
                                   
                                    @error('kids_games')
                                    <span class="error invalid-feedback">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label>Kids Pool</label>
                                    <input type="number" min=0 step=1 name="kids_pools" class="form-control @error('kids_pools') is-invalid @enderror"
                                           placeholder="{{ __('kids_pools') }}"
                                           value={{    ($pool)?$pool->kids_pools:old('kids_pools') }} 
                                            autocomplete="length" >
                                   
                                    @error('kids_pools')
                                    <span class="error invalid-feedback">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label>Kitchen</label>
                                    <input type="number" min=0 step=1 name="kitchen" class="form-control @error('kitchen') is-invalid @enderror"
                                           placeholder="{{ __('kitchen') }}"
                                           value={{    ($pool)?$pool->kitchen:old('kitchen') }} 
                                            autocomplete="length" >
                                   
                                    @error('kitchen')
                                    <span class="error invalid-feedback">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label>Stereo</label>
                                    <input type="number" min=0 step=1 name="stereo" class="form-control @error('stereo') is-invalid @enderror"
                                           placeholder="{{ __('stereo') }}"
                                           value={{    ($pool)?$pool->stereo:old('stereo') }} 
                                            autocomplete="length" >
                                   
                                    @error('stereo')
                                    <span class="error invalid-feedback">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label>TV</label>
                                    <input type="number" min=0 step=1 name="tv" class="form-control @error('tv') is-invalid @enderror"
                                           placeholder="{{ __('tv') }}"
                                           value={{    ($pool)?$pool->tv:old('tv') }} 
                                            autocomplete="length" autofocus>
                                   
                                    @error('tv')
                                    <span class="error invalid-feedback">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                    </div>

                            </div>-->

                            <div class="row mb-3">
                                <label class="col-md-12 py-2 border-bottom bg-info">Land Size</label>
                                <div class="col-md-6">
                                    <label>Length</label>
                                <input type="number" min=0 step=0.1 name="land_length" class="form-control @error('land_length') is-invalid @enderror"
                                       placeholder="{{ __('Length') }}"
                                       value={{    ($pool)?$pool->land_length:old('land_length') }} 
                                        autocomplete="land_length" autofocus>
                               
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
                                            autocomplete="land_width" autofocus>
                                   
                                    @error('land_width')
                                    <span class="error invalid-feedback">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                    </div>

                            </div>
                            <div class="row mb-3">
                              
                                <div class="col-md-12 d-none">
                                    <label>No. of Rooms</label>
                                <input type="number" min=0 step=0.1 name="no_of_rooms" class="form-control @error('no_of_rooms') is-invalid @enderror"
                                       placeholder="{{ __('Number of Rooms') }}"
                                       value={{    ($pool)?$pool->no_of_rooms:old('no_of_rooms') }} 
                                        autocomplete="no_of_rooms" autofocus>
                               
                                @error('no_of_rooms')
                                <span class="error invalid-feedback">
                                    {{ $message }}
                                </span>
                                @enderror
                                </div>
                              

                            </div>
                            <div class="row mb-3">

                                <div class="col-md-6">
                                    <label>Normal Price(BHD)</label>
                                <input type="number" min=0 step=0.1 name="price" class="form-control @error('price') is-invalid @enderror"
                                       placeholder="{{ __('Normal Price(BHD)') }}"
                                       value={{    ($pool)?$pool->price:old('price') }} 
                                       required autocomplete="price" autofocus>
                               
                                @error('price')
                                <span class="error invalid-feedback">
                                    {{ $message }}
                                </span>
                                @enderror
                                </div>
                                <div class="col-md-6">
                                    <label>Holiday Price(BHD) </label>
                                    <input type="number" min=0 step=0.1 name="holiday_price" class="form-control @error('holiday_price') is-invalid @enderror"
                                           placeholder="{{ __('Holiday Price(BHD)') }}"
                                           value={{    ($pool)?$pool->holiday_price:old('holiday_price') }} 
                                            autocomplete="holiday_price" autofocus>
                                   
                                    @error('holiday_price')
                                    <span class="error invalid-feedback">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                    </div>

                            </div>
                            <div class="row mb-3">
                                <label class="col-md-12 bg-info py-2">Address</label>   
                                <div class="col-md-2">
                                    <label>city</label>
                                <input type="text" name="city" class="form-control @error('city') is-invalid @enderror"
                                       placeholder="{{ __('City') }}"
                                       value='{{    ($pool)?$pool->city:old('city') }}'
                                        autocomplete="city" autofocus>
                               
                                @error('city')
                                <span class="error invalid-feedback">
                                    {{ $message }}
                                </span>
                                @enderror
                                </div>
                                <div class="col-md-2">
                                    <label>State </label>
                                    <input type="text"  name="state" class="form-control @error('state') is-invalid @enderror"
                                           placeholder="{{ __('State') }}"
                                           value='{{    ($pool)?$pool->state:old('state') }}'
                                            autocomplete="state" autofocus>
                                   
                                    @error('state')
                                    <span class="error invalid-feedback">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                    </div>
                                    <div class="col-md-2">
                                        <label>Latitude</label>
                                    <input type="text" name="latitude" class="form-control @error('latitude') is-invalid @enderror"
                                           placeholder="{{ __('Latitude') }}"
                                           value='{{    ($pool)?$pool->latitude:old('latitude') }}'
                                            autofocus>
                                   
                                    @error('city')
                                    <span class="error invalid-feedback">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                    </div> <div class="col-md-2">
                                        <label>Longitude</label>
                                    <input type="text" name="longitude" class="form-control @error('longitude') is-invalid @enderror"
                                           placeholder="{{ __('Longitude') }}"
                                           value='{{    ($pool)?$pool->longitude:old('longitude') }}'
                                            autofocus>
                                   
                                    @error('longitude')
                                    <span class="error invalid-feedback">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label>Street </label>
                                        <input type="text" name="street" class="form-control @error('street') is-invalid @enderror"
                                               placeholder="{{ __('Street') }}"
                                               value='{{    ($pool)?$pool->state:old('street') }}'
                                                autocomplete="street" autofocus>
                                       
                                        @error('street')
                                        <span class="error invalid-feedback">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                        </div>

                            </div>
                            <hr>
                            <div class=" mb-3 d-none">
                                <label class="form-label">{{ __('Description') }}</label>
                                <textarea rows="4" cols="20" name="features" class="form-control @error('features') is-invalid @enderror"
                                       placeholder="{{ __('features') }}"  autocomplete="features" autofocus>
                                       {{    ($pool)?$pool->features:old('features') }}
                                    </textarea>
                              
                                @error('features')
                                <span class="error invalid-feedback">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class=" mb-3 d-none">
                                <label class="form-label">{{ __('Rules') }}</label>
                                <textarea rows="4" cols="20" name="rules" class="form-control @error('rules') is-invalid @enderror"
                                       placeholder="{{ __('rules') }}"  autocomplete="rules" autofocus>
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
<script>
     $(document).ready(function(){
            $(".remove_feature").click(function(){
                alert();
                    $(this).parent().remove();
            });
        });
    /*$('textarea').tinymce({ height: 400,
        
        plugins: [
          'advlist autolink lists link image',
          'insertdatetime media table paste  wordcount'
        ], 
        toolbar: [
            "heading| bold italic | bullist numlist",
            "code"
            ],  });
     */       
            $(".add_feature").click(function(){
                var append = '<div class="row mt-1">'+   
                             '<div class="col-md-4 mt-1">'+
                                    '<input type="text" name="feature_title[]" class="form-control">'+
                                    '</div>'+
                                    '<div class="col-md-3 mt-1">'+
                                    '<input type="number" min=0 name="feature_value[]" class="form-control">'+
                                    '</div>'+
                                    '<div class="col-md-3 mt-1">'+
                                    '<input type="file" name="feature_icon[]" class="form-control">'+
                                    '</div>'+
                                    '<div class="col-md-2 mt-1 text-center">'+
                                    '<span class="btn btn-sm btn-danger remove_feature" onclick="remove(this)"><i class="fa fa-trash"> </i></span>'+
                                    '</div>'+
                                '</div>';
                $(".feature").append(append);
            });
           function remove(ele)
           {
            $(ele).parent().parent().remove();
           }
            $(".delete").click(function(){
            var href = $(this).data('href');
        Swal.fire({
  title: "Are you sure?",
  text: "You won't be able to revert this!",
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: "#3085d6",
  cancelButtonColor: "#d33",
  confirmButtonText: "Yes, delete it!"
}).then((result) => {
  if (result.isConfirmed) {
    Swal.fire({
      title: "Deleted!",
      text: "Your file has been deleted.",
      icon: "success"
    });
    window.location.href=href;
  }
});
        });
       
  </script>
@endsection
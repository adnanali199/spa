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
                               <div class="row">
                                <div class="col-md-4">
                                    <label>{{__('Feature Name')}}</label>
                                </div>
                                <div class="col-md-4">
                                    <label>{{__('Feature Value')}}</label>
                                </div>
                                </div>
                                
                               </div>
                                @if($pool && count($features1)>0)
                                <?php $i=0;  ?>
                                @foreach($features1 as $feature1)
                                
                                <div class="row">    
                                    <div class="col-4 mt-1">
                                        <select name="feature_id[]" class="select2  form-control">
                                            @foreach($features as $feature)
                                            <option value="{{$feature->id}}" @if($feature->id==$feature1->feature_id) selected @endif>
                                            {{$feature->feature_title}}
                                            </option>
                                            @endforeach
                                           </select>
                                    </div>
                                    <div class="col-4 mt-1">
                                        <input type="number" min="0" step="1" name="feature_value[]" value="{{$feature1->feature_value}}" class="  form-control"
                                        placeholder="{{__('Feature Value')}}">
                                          
                                    </div>
                                        
                                        <div class="col-2 mt-1 text-center">
                                            @if($i==0)
                                            <span class="btn btn-sm btn-success add_feature"><i class="fa fa-plus"> </i></span>
                                            @else
                                            <span class="btn btn-sm btn-danger remove_feature" onclick="remove(this)"><i class="fa fa-trash"> </i></span>
                                            @endif
                                        </div>
                                    </div>
                                    @php 
                                    $i++;
                                    @endphp
                                @endforeach
                                @else
                                <div class="row">    
                                    <div class="col-md-4 mt-1">
                                        <select name="feature_id[]" class="select2 form-control">
                                            @foreach($features as $feature)
                                            <option value="{{$feature->id}}">
                                            {{$feature->feature_title}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-4 mt-1">
                                        <input type="number" min="0" step="1" name="feature_value[]" value="" class="  form-control"
                                        placeholder="{{__('Feature Value')}}">
                                          
                                    </div>
                                    
                                    <div class="col-md-2 mt-1 text-center">
                                        <span class="btn btn-sm btn-success add_feature"><i class="fa fa-plus"> </i></span>
                                    </div>
                                </div>
                                @endif
                         
                            

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

                                <div class="col-md-4">
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
                                <div class="col-md-4">
                                    <label>Holiday Price(BHD) </label>
                                    <input type="number" min=0 step=0.1 name="holiday_price" class="form-control @error('holiday_price') is-invalid @enderror"
                                           placeholder="{{ __('Holiday Price(BHD)') }}"
                                           value={{    ($pool)?$pool->holiday_price:old('holiday_price') }} 
                                            >
                                   
                                    @error('holiday_price')
                                    <span class="error invalid-feedback">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label>Advance Price(BHD) </label>
                                        <input type="number" min=0 step=0.1 name="advance_price" class="form-control @error('advance_price') is-invalid @enderror"
                                               placeholder="{{ __('Advance Price(BHD)') }}"
                                               value={{    ($pool)?$pool->advance_price:old('advance_price') }} 
                                                >
                                       
                                        @error('advance_price')
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
                    $(this).parent().parent().remove();
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
                             '<div class="col-4 mt-1">'+
                             '<select name="feature_id[]" class="select2 form-control">';
                                        
                                    @foreach($features as $feature)
                                    append +='<option value="{{$feature->id}}">{{$feature->feature_title}}</option>';
                                    @endforeach
                                   append+='</select> </div> <div class="col-4 mt-1"> <input type="number" min="0" step="1" name="feature_value[]" value="" class="  form-control" placeholder="{{__('Feature Value')}}"> </div><div class="col-2 mt-1 text-center"><span class="btn btn-sm btn-danger remove_feature" onclick="remove(this)"><i class="fa fa-trash"> </i></span></div></div>';
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
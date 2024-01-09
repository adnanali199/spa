@extends('frontend.layouts.app')
@section('styles')
<style>
  .list{
    display:inline-block;
    padding:2px;margin:2px;
  }
  #searchbtn{
    position: absolute;right:3%;top:20%;font-size:20px;
  }
  .border2{
    
  }
  @media screen and (max-width:767px)
  {
    #searchbtn{
    right:8%;
  }
  }
</style>
@endsection
@section('content')
<div class="container">
  <div class="card mt-4">
    <div class="card-body p-2">
    <form class="mb-2" id="searchform" method="post" action={{route('pool.search')}}>
      @csrf
      <div class="row mt-3">
        <div class="col-12 col-md-12 relative">
          
            <input type="text" name="city" style="border-radius:30px" class="form-control" placeholder="City" value="{{$city??''}}">
            <i class="fas fa-search " id="searchbtn" class="btn" type="submit"  ></i>
           
        </div>
        
      </div>
      <hr class="mt-2">
      <div class="row mt-2">
        <div class="col-6 col-md-6" style="border-right:1px solid #bbb;height:35px">
          
          <input class="datepicker " style="border:0px;background:none;width:100%;height:100%"  name="date_from" type="text" placeholder="Date From" value="{{$date_from??''}}" />
        </div>
        <div class="col-6 col-md-6">
          
          <input class="datepicker " style="border:0px;background:none;width:100%;height:100%"  name="date_to" type="text" placeholder="Date To" value="{{$date_to??''}}" />
        </div>
        
       
      </div>
      <hr class="mt-2">
      <div class="row mt-4 px-3">
        <!-- Button trigger modal -->

        <div class="col-6 col-md-6" style="font-size:14px;font-weight:bold;color:#bbb" data-toggle="modal" data-target="#filterModal">
          <i class="fas fa-sliders-h"  style="font-size:20px;color:#333">&nbsp; </i> {{__('FILTERS')}} 
        </div>
        <div class="col-6 col-md-6" style="font-size:14px;font-weight:bold;color:#bbb" data-toggle="modal" data-target="#sortingModal">
          <svg xmlns="http://www.w3.org/2000/svg" style="font-size:20px;" height="16" width="18" viewBox="0 0 576 512"><path d="M151.6 42.4C145.5 35.8 137 32 128 32s-17.5 3.8-23.6 10.4l-88 96c-11.9 13-11.1 33.3 2 45.2s33.3 11.1 45.2-2L96 146.3V448c0 17.7 14.3 32 32 32s32-14.3 32-32V146.3l32.4 35.4c11.9 13 32.2 13.9 45.2 2s13.9-32.2 2-45.2l-88-96zM320 480h32c17.7 0 32-14.3 32-32s-14.3-32-32-32H320c-17.7 0-32 14.3-32 32s14.3 32 32 32zm0-128h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H320c-17.7 0-32 14.3-32 32s14.3 32 32 32zm0-128H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H320c-17.7 0-32 14.3-32 32s14.3 32 32 32zm0-128H544c17.7 0 32-14.3 32-32s-14.3-32-32-32H320c-17.7 0-32 14.3-32 32s14.3 32 32 32z"/> </svg> {{__('SORT')}}
        </div>
        
       
      </div>
    </form>
  </div>
</div>
  </div>
  <div class="container" id="pools">


<div class="row py-2">
    @if($pools)
    @foreach($pools as $pool)
    
 <div class=" col-6 col-sm-3">
    <a href="{{route('pool.book',$pool->id)}}">
    <div class="card mt-1">
        <div class="card-body p-0">
        <div style="" class="slider">
            @foreach($pool->images as $image)
            <img src=" {{ asset('uploads/'.$image->pool_image) }} " width="100%" class="img img-responsive" height="80px">
            @endforeach       
        </div>
        <div class=" py-1 ">
          <div class="px-3">
        
            <div class="row">
            <div class="col-12 col-xs-12 col-md-12 text-center "><h6 class="mb-0">{{ $pool->short_name }}</h6></div>
            <div class="col-12 col-xs-!2 col-md-12   text-danger text-sm" style="font-size:12px">STARTING: $ {{ number_format($pool->price,2) }}</div>
            <div class="col-md-12"><i class="fa fa-map-marker text-primary" style="font-size:12px" aria-hidden="true"></i>  {{ $pool->city }}</div>
            </div>
        </div>
      </div>
    </div>
        <!-- /.card-body -->

       
    </div>
</a>
</div>

    @endforeach
    @else
    <div class="col-md-12 text-center">No Matched Pools..</div>
    @endif

</div>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{__('Filters')}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="card">
        <div class="card-body">
          <div class="form-group row">
              <lable>
                {{ __('Price:') }}
              </lable>
              <div class="col-5">
                <input type="number" min="0.0" step="0.1" class="form-control" name="price_min" placeholder="{{__('Min')}}">
              </div>
              <div class="col-5">
                <input type="number" min="0.0" step="0.1" class="form-control" name="price_max" placeholder="{{__('Max')}}">
              </div>
            
          </div>
        </div>
       </div>
      </div>
      <div class="modal-footer">        <button type="button" class="btn btn-primary">{{__('Show Results')}}</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="sortingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1">{{__('Sorting')}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card">
          <div class="card-body">
            <div class="form-group row">
              
                <lable class="col-10">
                  <input type="radio" class="" name="sort">
                  {{ __('Nearest Date') }}
                </lable>
                
               
              
            </div>
            <div class="form-group row">
              <lable class="col-10">
               
                  <input type="radio" class="" name="sort">
               
                {{ __('Price (Low to High)') }}
              </lable>
             
             
            
          </div>
          <div class="form-group row">
            <lable class="col-10">
              <input type="radio" class="" name="sort">
              {{ __('Price(Hight to Low)') }}
            </lable>
         
           
          
        </div>
          </div>
         </div>
      </div>
      <div class="modal-footer">
       
        <button type="button" class="btn btn-primary">{{__('Show Results')}}</button>
      </div>
    </div>
  </div>
</div>
@endsection
@section('scripts')
<script>
  $(document).ready(function(){
    $("#searchbtn").click(function(){
        $("#searchform").submit();
     });
  });
</script>
@endsection
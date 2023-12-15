@extends('frontend.layouts.app')
@section('styles')
<style>
  .list{
    display:inline-block;
    padding:2px;margin:2px;
  }
  .border2{
    
  }
</style>
@endsection
@section('content')
<div class="s002">
    <form method="post" action={{route('pool.search')}}>
      @csrf
        <fieldset>
            <legend>SEARCH Pool</legend>
          </fieldset>
      <div class="inner-form mt-3">
        <div class="input-field first-wrap">
          <div class="icon-wrap">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
              <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"></path>
            </svg>
          </div>
          <input id="search" name="search_term" value="{{$search??''}}" type="text" placeholder="What are you looking for?" />
        </div>
        <div class="input-field second-wrap">
          <div class="icon-wrap">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
              <path d="M17 12h-5v5h5v-5zM16 1v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2h-1V1h-2zm3 18H5V8h14v11z"></path>
            </svg>
          </div>
          <input class="datepicker" id="depart" name="date_from" type="text" placeholder="Date From" value="{{$date_from??''}}" />
        </div>
        <div class="input-field third-wrap">
          <div class="icon-wrap">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
              <path d="M17 12h-5v5h5v-5zM16 1v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2h-1V1h-2zm3 18H5V8h14v11z"></path>
            </svg>
          </div>
          <input class="datepicker" id="return" name="date_to" type="text" placeholder="Date To" value="{{$date_to??''}}" />
        </div>
        <div class="input-field fouth-wrap">
          <div class="icon-wrap">
            
          </div>
         <input type="text" name="city" class="form-control" placeholder="City" value="{{$city??''}}">
        </div>
        <div class="input-field fifth-wrap">
          <button class="btn-search" type="submit">SEARCH</button>
        </div>
      </div>
    </form>
  </div>
  <div class="container" id="pools">
<h2 class="my-3 mt-5 mx-auto text-center" >Pools List</h2>
<hr>
<div class="row py-2">
    @if($pools)
    @foreach($pools as $pool)
    
 <div class="col-sm-3">
    <a href="{{route('pool.details',$pool->id)}}">
    <div class="card mt-1">
        <div class="card-body p-0">
        <div style="" class="slider">
            @foreach($pool->images as $image)
            <img src=" {{ asset('uploads/'.$image->pool_image) }} " width="100%" class="img img-responsive" height="175px">
            @endforeach       
        </div>
        <div class="px-2 py-1 ">
          <div class="px-3">
        
            <div class="row">
            <div class="col-12 col-xs-12 col-md-12 text-center"><h4>{{ $pool->short_name }}</h4></div>
            <div class="col-12 col-xs-!2 col-md-12   text-danger">STARTING FROM: $ {{ number_format($pool->price,2) }}</div>
            <div class="col-md-12"><i class="fa fa-map-marker text-primary" aria-hidden="true"></i>  {{ $pool->city }}</div>
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
@endsection
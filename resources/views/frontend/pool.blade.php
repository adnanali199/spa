@extends('frontend.layouts.app')
@section('styles')
<style>
img.icon1{
    min-width:50px!important;
    max-width:70px!important;
    width:50px!important;
}
@media screen and(max-width:667px)
{
    .container-fullwidth{
        padding-left:30px;
        padding-right:30px;
    }
}
h6{
    font-size:18px;
}
</style>
@endsection
@section('content')
<div class="container-fullwidth">
<h1 class=" mt-5 mx-auto text-center">{{$pool->pool_name}}</h1>
<hr>
<div class="row ">
    
  
    <div class="col-sm-3"></div>
 <div class="col-sm-6">
  
    <div class="card">
        <div class="card-body p-0">
        <div style="" class="slider">
            @foreach($pool->images as $image)
            <img src=" {{ asset('uploads/'.$image->pool_image) }} " width="100%" height="400px" class="img img-responsive">
            @endforeach       
        </div>
        <div class="px-2 py-3 ">
            <div class="px-3">
        
        <div class="row">
        <div class="col-6 col-xs-6 col-md-6">{{ $pool->short_name }}</div>
        <div class="col-6 col-xs-6 col-md-6  text-right text-danger">STARTING FROM: $ {{ number_format($pool->price,2) }}</div>
        <div class="col-md-12 mt-4"><i class="fa fa-map-marker text-primary" aria-hidden="true"></i>  {{ $pool->city }}</div>
        </div>
    </div>
        <hr>
        <section>
            <div class="row px-3">
                <div class="col-md-12 ">
                <h4>Features</h4>
                
                
                </div>
                @foreach($features as $feature)
                <div class="col-3 col-xs-3 text-center">
                <img class="img img-responsive icon1" width="" src="{{ asset('icons/'.$feature->feature_icon) }}">
                <h6 class="text-info mt-1"> {{$feature->feature_title??0}} * {{$feature->feature_value}} </h6>
                </div>
                @endforeach
                
                
            </div>
            <div class="row px-3">
               <div class="col-md-12">
                <h3 style="margin-bottom:10px">Price Details </h3>
               </div>
                <div class="col-6 col-xs-6">Normal Price:</div>
                <div class="col-6 col-xs-6 text-right"><strong>{{ $pool->price??0.00 }} BHD</strong></div>
                
                    <div class="col-6 col-xs-6">Down Payment:</div>
                    <div class="col-6 col-xs-6 text-right"><strong> 10 BHD </strong>   
               </div>
                
                
                    <div class="col-6 col-xs-6">Holiday Price:</div>
                    <div class="col-6 col-xs-6 text-right"><strong> {{ $pool->holiday_price??0.00 }} BHD </strong>   
               </div>

           
        </div>
        <div class="row px-3 pt-3">
            <div class="col-md-12">
             <h3 style="margin-bottom:10px">ADDRESS: </h3>
            </div>
             <div class="col-xs-12" id="map">

             </div>
            
             
             

        
     </div>

    
        </section>

        <hr>
        <section>
            <div class="row">
                <div class="col-md-12 px-5">
                <h4>Rules</h4>
                <p><?php echo $pool->rules; ?></p>
                </div>
            </div>
        </section>
       
        </div>
    </div>
        <!-- /.card-body -->

        <div class="card-footer clearfix">
            <a href="{{ route('pool.book',$pool->id)}}" style="width:100%;height:40px;padding-top:8px" class="w-full float-right btn btn-sm btn-info btn-lg"><i class="fa fa-calendar" aria-hidden="true"></i> BOOK NOW</a> 
              
        </div>
    </div>

</div>
 
</div>
</div>
</div>
@endsection
@section('scripts')
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB41DRUbKWJHPxaFjMAwdrzWzbVKartNGg&callback=initMap&libraries=places&v=weekly"
      defer
    ></script>
<script type="text/javascript">
    function initMap() {
  const sydney = new google.maps.LatLng(-33.867, 151.195);

  infowindow = new google.maps.InfoWindow();
  map = new google.maps.Map(document.getElementById("map"), {
    center: sydney,
    zoom: 15,
  });

  const request = {
    query: "Museum of Contemporary Art Australia",
    fields: ["name", "geometry"],
  };

  service = new google.maps.places.PlacesService(map);
  service.findPlaceFromQuery(request, (results, status) => {
    if (status === google.maps.places.PlacesServiceStatus.OK && results) {
      for (let i = 0; i < results.length; i++) {
        createMarker(results[i]);
      }

      map.setCenter(results[0].geometry.location);
    }
  });
}

function createMarker(place) {
  if (!place.geometry || !place.geometry.location) return;

  const marker = new google.maps.Marker({
    map,
    position: place.geometry.location,
  });

  google.maps.event.addListener(marker, "click", () => {
    infowindow.setContent(place.name || "");
    infowindow.open(map);
  });
}

window.initMap = initMap;
    </script>
@endsection
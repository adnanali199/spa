@extends('frontend.layouts.app')
@section('styles')
<style>

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
<h1 class=" mt-5 mx-auto text-center">{{__('My Bookings')}}</h1>
<hr>
<div class="row ">
    
  
    @foreach($bookings as $booking)
   
 <div class="col-md-3">
  
    <div class="card">
        <div class="card-body p-1">
            <div style="height:150px" class="slider" >
                @foreach($booking->pool->images as $image)
                                <img src=" {{ asset('uploads/'.$image->pool_image) }} " width="100%" height="150px" class="img img-responsive">
                @endforeach       
            </div>
            <h4 class=" mt-2 text-center">
            {{$booking->pool->pool_name}}
            </h4>
            <?php
            if($booking->status==2)
            {
                $status="<strong class='text-info'>Pending</strong>";
            }
            elseif($booking->status==1)
            {
                $status="<strong class='text-success'>Approved </strong>";
            }
            else{
                $status="<strong class='text-danger'>Rejected</strong>";
            }
            ?>
            <p class="text-center">{{ date("d M Y",strtotime($booking->booking_date))}} | {{ $booking->slot }} | <?php echo $status; ?></p>
        </div>
        <!-- /.card-body -->

       
    </div>

</div>
 @endforeach
</div>
</div>
</div>
@endsection

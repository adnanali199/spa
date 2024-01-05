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
    @auth
   @if($bookings)
    @foreach($bookings as $booking)
   
 <div class="col-md-3">
  
    <div class="card">
        <div class="card-body p-1">
            <table class="table">
                <tr>
                <th class="col-4">{{ __('Pool') }}</th>
                <th class="col-4">{{ __('Date')}}</th>
                <th class="col-4">{{ __('Slot')}}</th>
                </tr>
           @foreach ($booking->pools as $pool )
                <tr>
                <td class="col-4">{{$pool->pool_name}}</td>
                <td class="col-4">{{ $pool->pivot->booking_date}}</td>
                <td class="col-4">{{ ($pool->pivot->slot_id==1)?'Day':'Night' }}</td>
                </tr>
               @endforeach
            </table>
            <h4 class=" mt-2 text-center">
           
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
            <p class="text-center">{{ date("d M Y",strtotime($booking->booking_date))}}  | <?php echo $status; ?></p>
        </div>
        <!-- /.card-body -->

       
    </div>

</div>
 @endforeach
 @else
<div class="col-12 text-center">{{ __('No Bookings Yet') }}</div>
 @endif
 @else
 <div class="text-center col-12">
    <div class="card" style="margin:0px auto">
        <div class="card-body">
    <h4> {{ __('Please Login to view your bookings status') }} <h4></div>
    </div>
</div>
 @endauth
</div>
</div>
</div>
@endsection

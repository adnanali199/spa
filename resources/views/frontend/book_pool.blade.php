@extends('frontend.layouts.app')

@section('content')
<div class="container">
<h1 class="my-3 mt-5 mx-auto text-center">{{$pool->pool_name}}</h1>
<hr>
<div class="row py-5">
    
  
    
 <div class="col-sm-6">
  
    <div class="card ">
        <div class="card-body p-0">
        <div style="" class="slider">
            @foreach($pool->images as $image)
            <img src=" {{ asset('uploads/'.$image->pool_image) }} " width="100%" class="img img-responsive">
            @endforeach       
        </div>
        <div class="px-3 py-3 ">
            <div class="px-3">
                <h3 class="text-center">{{ $pool->pool_name }}</h3>
                <div class="row">
                <div class="col-6 col-xs-6 col-md-6">{{ $pool->short_name }}</div>
                <div class="col-6 col-xs-6 col-md-6  text-right text-danger">STARTING FROM: $ {{ number_format($pool->price,2) }}</div>
                <div class="col-md-12 mt-4"><i class="fa fa-map-marker text-secondary" aria-hidden="true"></i>  {{ $pool->city }}</div>
                </div>
            </div>
        <hr>
        <div class="mx-4">
            <section>
                <div class="row ">
                    <div class="col-md-12 ">
                    <h4>Features</h4>
                    
                    
                    </div>
                    <div class="col-3 col-xs-3 text-center">
                    <img class="img img-responsive icon1" width="" src="{{ asset('images/icons/anteroom.svg') }}">
                    <h6 class="text-info mt-1"> {{$pool->anteroom??0}} * Anteroom </h6>
                    </div>
    
                    <div class="col-3 col-xs-3 text-center">
                        <img class="img img-responsive icon1 img-circle img-thumbnail" width="" src="{{ asset('images/icons/bathroom.svg') }}">
                        <h6 class="text-info mt-1"> {{$pool->bathroom??0}} * Bathroom </h6>
                    </div>
    
                    <div class="col-3 col-xs-3 text-center">
                        <img class="img img-responsive icon1" width="" src="{{ asset('images/icons/shower.svg') }}">
                        <h6 class="text-info mt-4"> {{$pool->shower??0}} * Shower </h6>
                    </div>
    
                    <div class="col-3 col-xs-3 text-center">
                        <img class="img img-responsive icon1" width="" src="{{ asset('images/icons/bbq.svg') }}">
                        <h6 class="text-info mt-4"> {{$pool->bbq??0}} * BBQ </h6>
                    </div>
    
                    <div class="col-3 col-xs-3 text-center">
                        <img class="img img-responsive icon1" width="" src="{{ asset('images/icons/bedroom.svg') }}">
                        <h6 class="text-info mt-1"> {{$pool->bedroom??0}} * Bedrooms </h6>
                    </div>
                    <div class="col-3 col-xs-3 text-center">
                        <img class="img img-responsive icon1" width="" src="{{ asset('images/icons/guests.svg') }}">
                        <h6 class="text-info mt-4"> {{$pool->guests_allowed??0}} * Guests Allowed </h6>
                    </div>
                    <div class="col-3 col-xs-3 text-center">
                        <img class="img img-responsive icon1" width="" src="{{ asset('images/icons/kids_games.svg') }}">
                        <h6 class="text-info mt-4"> {{$pool->kids_games??0}} * Kids Games </h6>
                    </div>
                    <div class="col-3 col-xs-3 text-center">
                        <img class="img img-responsive icon1" width="" src="{{ asset('images/icons/kids_pools.svg') }}">
                        <h6 class="text-info mt-4"> {{$pool->kids_pools??0}} * Kids Pools </h6>
                    </div>
                    <div class="col-3 col-xs-3 text-center">
                        <img class="img img-responsive icon1" width="" src="{{ asset('images/icons/kitchen.svg') }}">
                        <h6 class="text-info mt-4"> {{$pool->kitchen??0}} * Kitchen </h6>
                    </div>
                    <div class="col-3 col-xs-3 text-center">
                        <img class="img img-responsive icon1" width="" src="{{ asset('images/icons/stereo.svg') }}">
                        <h6 class="text-info mt-4"> {{$pool->stereo??0}} * Stereo </h6>
                    </div>
                    <div class="col-3 col-xs-3 text-center">
                        <img class="img img-responsive icon1" width="" src="{{ asset('images/icons/tv.svg') }}">
                        <h6 class="text-info mt-4"> {{$pool->tv??0}} * TV </h6>
                    </div>
                    
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
                <div class="col-md-12">
                <h4>Rules</h4>
                <p><?php echo $pool->rules; ?></p>
                </div>
            </div>
        </section>
    </div>
        </div>
    </div>
        <!-- /.card-body -->

        
    </div>

</div>
 <div class="col-md-6">
    <h3>Booking Form </h3>
    <hr>
    <form action="{{route('pool.bookaction')}}" method="POST">
        @csrf
        <input type="hidden" name="pool_id" id="pool_id" value="{{$pool->id}}">
        <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
        <input type="hidden" id="owner_id" value="{{$pool->owner_id}}">
        <div class="form-group">
            <input class="datepicker1 form-control readonly" readonly autocomplete="off" id="booking_date" name="booking_date" value="<?php echo date('Y-m-d') ?>"  type="text" placeholder="Booking Date" required />
        </div>
        <!-- Day/Night -->
        <div class="form-group row slots">
        
       
        </div>
        <!-- /Day/Night -->
        <!-- Day/Night -->
        <div class="form-group row">
            <div class="col-md-6">
                <label>
                    IBAN <input type="radio"  name="payment_mode" class="payment_mode" value="iban">
                </label>
            </div>
            <div class="col-md-6">
                <label>
                    Credit Card <input type="radio" name="payment_mode" class="payment_mode" value="credit_card">
                </label>
            </div>
            </div>
            <div class="row d-none" id="iban_show">
                <div class="col-12">
                    <div class="form__div">
                        <input type="text" readonly name="iban" id="iban_field" class="form-control" placeholder="IBAN ">
                        <label for="" class="form__label">IBAN <span class="text-right"> <span id="copy_iban" class="mt-2 btn btn-sm btn-success">Copy IBAN</span></span></label>
                    </div>
                   
                </div>
            </div>
            <div class="row d-none" id="card_show">
                <div class="col-12">
                    <div class="form__div">
                        <input type="text" class="form-control" placeholder=" " name="card_number">
                        <label for="" class="form__label">Card Number</label>
                    </div>
                </div>

                <div class="col-6">
                    <div class="form__div">
                        <input type="text" class="form-control" placeholder=" " name="mm/yy">
                        <label for="" class="form__label">MM / yy</label>
                    </div>
                </div>

                <div class="col-6">
                    <div class="form__div">
                        <input type="password" class="form-control" placeholder=" " name="cvv_code">
                        <label for="" class="form__label">cvv code</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form__div">
                        <input type="text" name="name_on_card" class="form-control" placeholder=" ">
                        <label for="" class="form__label">name on the card</label>
                    </div>
                </div>
                
            </div>

        <div class="text-center">
            <button disabled id="submit_btn" class="w-full  btn  btn-info btn-lg">Proceed</button> 

        </div>
    </form>

 </div>
</div>
</div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function(){

    $("#booking_date").change(function(){
        var booking_date= $(this).val();
        if(booking_date)
        {
         
        }
    });
    var available_formatted_dates_list = <?php echo json_encode($dates); ?>;

function check_available_date(date) {

  var formatted_date = '',
    ret = [true, "", ""];
  if (date instanceof Date) {
    formatted_date = $.datepicker.formatDate('yy-mm-dd', date);
  } else {
    formatted_date = '' + date;
  }
  console.log(formatted_date,available_formatted_dates_list)
  if (-1 === available_formatted_dates_list.indexOf(formatted_date)) {
    ret[0] = false;
    ret[1] = "date-disabled";
    ret[2] = "Date not available";
  }
  return ret;
}

$(".datepicker1").change(function(){
    $.ajax( {
            url: "{{route('get_schedule')}}",
            type:"POST",
            data:  {
                _token:"{{csrf_token()}}",
                pool_id:$("#pool_id").val(),
                date:$(this).val()
            },
            success:function(result){
            $("#submit_btn").attr("disabled",true);  
              $(".slots").empty();
              var disable = false;
               for(r in result)
               {
             
               if(result[r].slot_id==2)
               {
                disable=true;
                var append = '<div class="col-md-6"><label> Night <input type="hidden" name="schedule_id" value="'+result[r].schedule_id+'"><input type="radio" name="slot_id"   class="" value="2"></label></div>';
               $(".slots").append(append);
               }
              else if(result[r].slot_id==1)
               {
                disable=true;
                var append = '<div class="col-md-6"><label> Day <input type="hidden" name="schedule_id" value="'+result[r].schedule_id+'"><input type="radio" name="slot_id"   class="" value="1"></label></div>';
               $(".slots").append(append);
               }
            }
            if(disable)
            {
                $("#submit_btn").removeAttr("disabled");
            }
            }
        });
});
    $(".datepicker1").datepicker(
        {
            changeMonth: true,
            changeYear: true,
            dateFormat: "yy-mm-dd",
            beforeShowDay: check_available_date
        }
    );
    $(".payment_mode").change(function(){
       
        if($(this).val()=="iban")
        {
            $("#iban_show").removeClass("d-none");
            $("#card_show").addClass("d-none");
        }
        else
        {
            $("#card_show").removeClass("d-none");
            $("#iban_show").addClass("d-none");
        }
    });

    $("#copy_iban").click(function(){
        owner_id = $("#owner_id").val();
        $.ajax( {
            url: "{{route('getOwnerIBAN')}}",
            data:  {
                owner_id:owner_id
            },
            success:function(result){
              
               $("#iban_field").val(result.iban);

            }
        });
    })
});
</script>
@endsection
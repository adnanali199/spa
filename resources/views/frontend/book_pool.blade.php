@extends('frontend.layouts.app')
@section('styles')
<style>
 
.disabled{
    background-color:rgba(251, 56, 56, 0.744)!important;
}
.nightavailable{
    background-color:rgba(255, 181, 44, 0.767);
}
.dayavailable{
    background-color:#5353ff;
    color:#FFF;
}
.dayavailable span{
    color:#FFF!important;
}
#d-picker-days div{
    font-size:16px;
  text-align:center;
  transition:all 0.5s ease-in-out;
}
#d-picker-days div.active span{

  color:red;
  font-family:'arial';


}

#d-picker-days div.active{
  font-weight:bold;
  border:1px solid #aaa!important;
  border-radius:50px;
  width:60px!important;
  height:60px;
 
}
.d-picker-outer ul li span{
  display:block;
  color:#8d8d8d;

  font-size:14px;
  margin:10px 0;
}

.d-picker-outer ul li.active span{
  display:block;
  color:red;
  font-family:'arial';
  font-size:18px;
  margin:5px 0;
}

.d-picker-outer ul li.active{
  font-size:26px;
  width:100px;
}
@media screen and (max-width:600px)
{
    #d-picker-days div.active{
  border-radius:50px;
  width:40px!important;
  height:40px;
  padding:2px!important;
 
}
#d-picker-days div{
    padding:0px!important;
    font-size:12px!important;
}
}
</style>
@endsection
@section('content')
<div class="container">
<h3 class="my-1 mt-5 mx-auto text-center">{{$pool->pool_name}}</h3>
<hr>
<div class="row py-3">
    
    <div class="col-md-12">
        
        <form action="{{route('pool.addToCart')}}" method="POST">
            @csrf
            <input type="hidden" name="pool_id" id="pool_id" value="{{$pool->id}}">
            <input type="hidden" name="user_id" value="0">
            @auth
            <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
            @endauth
           
            <input type="hidden" name="owner_id" id="owner_id" value="{{$pool->owner_id}}">
            <input  id="booking_date" name="booking_date" value="<?php echo date('Y-m-d') ?>"  type="hidden"  />
            <div class="form-group" id="step1">
                <div class="mb-3" >
                    <div class="">
                    <div class="d-picker-inner">
                       <div class="row">
                       <div class="col-6 d-picker-btn-group text-left">
                        <span class="mr-2 btn  cmbtn  btn-primary btn-sm" style="" id="bmbtn" data-title="previous"> < </span>
                        <span class=" text-center" id="current_month_title">
                
                        </span>
                        <span class="ml-2 btn  cmbtn btn-primary btn-sm" id="nmbtn" data-title="next" style=""> > </span>
                       </div>
                       <div class="col-6 text-right">
                        <span class="btn cmbtn btn-sm btn-warning d-none" id="cmbtn" data-title="current">current</span>
                        <button type="submit" class="btn  btn-sm btn-primary" id="cartbtn" title="Add to cart"><i class="fas fa-cart-plus"></i> </button>
                           
                        <input type="submit" name="submit"  class="btn  btn-sm btn-success"  title="Proceed To checkout" value="Book">
                    
                    </div>
                    </div>
                        <input type="hidden" id="current_month" data-name="" value="">
                        <input type="hidden" id="next_month" data-year=""    data-name="" value="">
                        <input type="hidden" id="prev_month" data-year=""   data-name="" value="">
                        <div id="d-picker-months"></div>
                        <div class="slider1" id="d-picker-days"></div>
                    </div>
                </div>
                </div>
                <div class="form-group row slots">
              
           
                </div>
            </div>
            
    
            
        </form>
    
     </div> 
    
 <div class="col-sm-12">
  
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
                    @foreach($features as $feature)
                    <div class="col-3 col-xs-3 text-center">
                    <img class="img img-responsive icon1" width="" src="{{ asset('icons/'.$feature->feature_icon) }}">
                    <h6 class="text-info mt-1"> {{$feature->feature_title??0}} * {{$feature->feature_value}} </h6>
                    </div>
                    @endforeach
                    
                </div>
                <div class="row px-3">
                   <div class="col-md-12">
                    <h3 style="margin-bottom:10px">{{__('Price Details')}} </h3>
                   </div>
                    <div class="col-6 col-xs-6">{{__('Normal Price:')}}</div>
                    <div class="col-6 col-xs-6 text-right"><strong>{{ $pool->price??0.00 }} BHD</strong></div>
                    
                        <div class="col-6 col-xs-6">{{__('Down Payment:') }}</div>
                        <div class="col-6 col-xs-6 text-right"><strong> {{ $pool->advance_price ?? 0.00}} BHD</strong>   
                   </div>
                    
                    
                        <div class="col-6 col-xs-6">Holiday Price:</div>
                        <div class="col-6 col-xs-6 text-right"><strong> {{ $pool->holiday_price??0.00 }} BHD </strong>   
                   </div>
    
               
            </div>
            <div class="row px-3 pt-3">
                <div class="col-md-12">
                 <h3 style="margin-bottom:10px">ADDRESS: </h3>
                 <p> {{$pool->street }} {{ $pool->city  }} {{ ",".$pool->state }}</p>
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
 
</div>


</div>


</div>

@endsection

@section('scripts')

<script>
   // Month array
   var monthArr = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul","Aug", "Sep", "Oct", "Nov", "Dec"];
   // unavailable dates 
   var unavailableDates = `<?php echo json_encode($dates); ?>`;
   var daysAvailable = `<?php echo json_encode($nightsbooked); ?>`;
   var nightsAvailable = `<?php echo json_encode($daysbooked); ?>`;

   // get next month dates.
    function firstOfNextMonth(date)
    {
      
        const today = new Date(date);
        // Get next month's index(0 based)
        const nextMonth = today.getMonth() + 1;
        // Get year
        const year = today.getFullYear() + (nextMonth === 12 ? 1: 0);
        // Get first day of the next month
        const firstDayOfNextMonth = new Date(year, nextMonth%12, 1);
        return firstDayOfNextMonth;
    }  
    // get previous month dates
    function firstOfPrevMonth(date)
    {
       var cmonth = new Date();
                // today's date
        const today = new Date(date);
        // Get next month's index(0 based)
        const nextMonth = today.getMonth() - 1;
        // Get year
        const year = today.getFullYear() - (nextMonth === 0 ? 1: 0);
        // Get first day of the next month
        const firstDayOfNextMonth = new Date(year, nextMonth%12, 1);
        if(firstDayOfNextMonth>=cmonth)
        {
        return firstDayOfNextMonth;
        }
        else{
            return cmonth;
        }
    }    
    // check if there is holiday
    function isHoliday(date,slot)
    {
        date = new Date(date);
        var day = date.getDay();
        console.log(day +" "+slot );
        if(day==4 && slot=="2")
        {
            return 1;
        }
        else if(day==5)
        {
            return 1;
        }
        else if(day==6 && slot==1)
        {
            return 1;
        }
        else{
            return 0;
        }
    }
    // get all dates of the current selected month
    function getAllDatesInMonthUTC(month='',year='') {
        var row = "";
        var startDate = new Date(Date.UTC(year, month, 1)); // month is 0-indexed
         // check if the current month
        cmonth  = new Date().getMonth();
       
        if(month==cmonth)
        {
            
             startDate = new Date(); // month is 0-indexed
        }    
        
        let endDate = new Date(Date.UTC(year, month + 1, 1));

       
        while (startDate < endDate) {
            var nextDate = new Date(startDate);
            var month = String(nextDate.getMonth()+1);
            var day   = String(nextDate.getDate());
            month = (month.length<2)?"0"+month:month;
            day = (day.length<2)?"0"+day:day;
         
            var formattedDate = nextDate.getFullYear()+"-"+month+"-"+day;
            
            var class1 = 'd-picker-date';
            
            if(unavailableDates.includes(formattedDate))
            {
                class1 ='disabled';
            }
            else if(daysAvailable.includes(formattedDate))
            {
                class1='dayavailable';
            }
            else if(nightsAvailable.includes(formattedDate))
            {
                class1='nightavailable';
            }
            var day = nextDate.toLocaleString('default', { weekday: 'short' });
            row+="<div onclick='dateClick(this)' data-mode='"+class1+"' data-date='"+formattedDate+"' class='ddate "+class1+"' style='padding:10px; border:1px solid #eee '><span style='font-weight:bold;color:#007bff'>"+day+"</span><br>"+nextDate.getDate()+"</div>";
          
            
            startDate.setUTCDate(startDate.getUTCDate() + 1);
        }
       
       $("#d-picker-days").html(row);
       //getSlots(date_selected);
    }

    function setDate1(date='')
    {
        if(date){
            date = new Date(date);
        }
        else{
            date = new Date();
        }
     
    var month = date.getMonth();
    var year = date.getFullYear();
    $("#current_month_title").html("<h5 style='display:inline-block'>"+monthArr[month]+" "+year+"</h5>");
    
    getAllDatesInMonthUTC(month,year); 
   
    $("#current_month").val(date);
    
    next = firstOfNextMonth(date);
    prev = firstOfPrevMonth(date);
   
    $("#next_month").val(next);
    $("#prev_month").val(prev);
    }
    function dateClick(ele){
        if($(ele).attr('data-mode')=="disabled"){
            return;
        }
        $(".ddate").removeClass('active');
       $(ele).addClass('active');
       var date_selected = $(ele).attr('data-date');
       $("#booking_date").val(date_selected);
       getSlots(date_selected);
    }

    function bookMe()
{
    var cart = <?php echo json_encode(\Session::get('cart')); ?>;
    if(cart=="null")
    {
        $("#cartbtn").click();
        setTimeout(() => {
            window.location.href="{{route('pool.checkout')}}";
        }, 5000);
    }
    else{
        window.location.href="{{route('pool.checkout')}}";
    }
    
}

    function getSlots(date)
    {
        
    $.ajax( {
            url: "{{route('get_schedule')}}",
            type:"POST",
            data:  {
                _token:"{{csrf_token()}}",
                pool_id:$("#pool_id").val(),
                date:date
            },
            success:function(result){
            $("#submit_btn").attr("disabled",true);  
            $(".slots").empty();
            var result = result.slots;
            console.log(result.nightsbooked +" "+date);
              var disable = false;
              
                
                
                if(result.unavailable.includes(date))
               {
                disable=true;
                var append = '';
               $(".slots").remove(append);
               }     
               else if(result.daysbooked.includes(date))
               {
                disable=true;
               var holiday =  isHoliday(date,2);
                var append = '<div class="col-md-6 col-6"><input type="hidden" name="holiday[]" value="'+isHoliday(date,2)+'"><label> Night <input required type="checkbox" name="slot_day" checked  class="radio" value="2"></label></div>';
               $(".slots").append(append);
               }
              else if(result.nightsbooked.includes(date))
               {
               
                disable=true;
                var append = '<div class="col-md-6 col-6 text-center"><input type="hidden" name="holiday[]" value="'+isHoliday(date,1)+'"><label> Day <input required type="checkbox" name="slot_night" checked  class="radio" value="1"></label></div>';
               $(".slots").append(append);
               }
              
              else{
                disable=true;
                var append = '<div class="col-md-6 col-6 text-center"><input type="hidden" name="holiday[]" value="'+isHoliday(date,1)+'"><label> Day <input type="checkbox" name="slot_day"  checked   class="radio" value="1"></label></div><div class="col-md-6 col-6"><input type="hidden" name="holiday[]" value="'+isHoliday(date,2)+'"><label> Night <input type="checkbox" name="slot_night"   class="radio" value="2"></label></div>';
                $(".slots").append(append);
              }
            
              
            if(disable)
            {
                $("#submit_btn").removeAttr("disabled");
            }
            }
        });

    }


$(document).ready(function(){
// call the calendar
setDate1();
$(".cmbtn").click(function(){
   $('.slider1').slick("unslick");
    var title = $(this).data('title');
   
    if(title=="current")
    {
        date = new Date();
    }
    else if(title=="next")
    {
        date = $("#next_month").val();
        //alert(date);
    }
    else{
        date= $("#prev_month").val();
    }
    setDate1(date);
   
    startSlick();

});




   

   
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
});
</script>
@endsection
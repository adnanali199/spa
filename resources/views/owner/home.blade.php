@extends('layouts.owner')
@section('styles')
<link rel="stylesheet" href="{{ asset('css/calander.css') }}">
<style>
    .tooltip-inner{
        color:#1E252B;
        background: none;
    }
    
.popper,
.tooltip {
  position: absolute;
  z-index: 9999;
  background: #FFC107;
  color: black;
  width: 150px;
  border-radius: 3px;
  box-shadow: 0 0 2px rgba(0,0,0,0.5);
  padding: 10px;
  text-align: center;
}

.popper .popper__arrow,
.tooltip .tooltip-arrow {
  width: 0;
  height: 0;
  border-style: solid;
  position: absolute;
  margin: 5px;
}

.tooltip .tooltip-arrow,
.popper .popper__arrow {
  border-color: #FFC107;
}
.style5 .tooltip .tooltip-arrow {
  border-color: #1E252B;
}
.popper[x-placement^="top"],
.tooltip[x-placement^="top"] {
  margin-bottom: 5px;
}
.popper[x-placement^="top"] .popper__arrow,
.tooltip[x-placement^="top"] .tooltip-arrow {
  border-width: 5px 5px 0 5px;
  border-left-color: transparent;
  border-right-color: transparent;
  border-bottom-color: transparent;
  bottom: -5px;
  left: calc(50% - 5px);
  margin-top: 0;
  margin-bottom: 0;
}
.popper[x-placement^="bottom"],
.tooltip[x-placement^="bottom"] {
  margin-top: 5px;
}
.tooltip[x-placement^="bottom"] .tooltip-arrow,
.popper[x-placement^="bottom"] .popper__arrow {
  border-width: 0 5px 5px 5px;
  border-left-color: transparent;
  border-right-color: transparent;
  border-top-color: transparent;
  top: -5px;
  left: calc(50% - 5px);
  margin-top: 0;
  margin-bottom: 0;
}
.tooltip[x-placement^="right"],
.popper[x-placement^="right"] {
  margin-left: 5px;
}
.btn.active{
    background-color:cadetblue;
}
.popper[x-placement^="right"] .popper__arrow,
.tooltip[x-placement^="right"] .tooltip-arrow {
  border-width: 5px 5px 5px 0;
  border-left-color: transparent;
  border-top-color: transparent;
  border-bottom-color: transparent;
  left: -5px;
  top: calc(50% - 5px);
  margin-left: 0;
  margin-right: 0;
}
.popper[x-placement^="left"],
.tooltip[x-placement^="left"] {
  margin-right: 5px;
}
.popper[x-placement^="left"] .popper__arrow,
.tooltip[x-placement^="left"] .tooltip-arrow {
  border-width: 5px 0 5px 5px;
  border-top-color: transparent;
  border-right-color: transparent;
  border-bottom-color: transparent;
  right: -5px;
  top: calc(50% - 5px);
  margin-left: 0;
  margin-right: 0;
}
#calendar{
   
}
.full-width{
    width:100%;
}
.pool_card{
    margin-bottom: 2px!important;
}
td.fc-day{
    height:30px!important;
}
.fc .fc-toolbar.fc-header-toolbar {
margin-bottom:0px;
}
.fc-toolbar, .fc-toolbar.fc-header-toolbar{
    padding:0px;line-height: 0px;
}
</style>
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Dashboard') }}</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
        
          <!--Owner Pools list -->
         <input type="hidden" name="default_pool" value="{{$pools[0]->id??0}}">
          <div class="slider">
            @foreach($pools as $pool)
            
         <div class="">
            <div class="card pool_card">
                <div class="card-body p-0" style='height:70px;'>
                    
                    <div class="">
                    <p class="text-center">
                       <label class="py-4" style="width:100%;height:100%"> {{ $pool->short_name }}
                        <input type="radio" style="width:40px;display:inline;height:1.2em" data-price="{{ $pool->price }}" data-advance="{{$pool->advance_price}}"  name="pool_id" data-owner_id="{{ $pool->owner_id }}" value="{{ $pool->id }}" class="pool_id  form-control" @if($loop->index==0) checked @endif > 
              
                       </label>
                        <input type="hidden" id="owner_id" value="{{ $pool->owner_id }}">  
                    </p>
                   
                   


            
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
            @endforeach
        </div>

        <!-- owner pools list ends -->
           
        <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
                <div class="row" id="bookingdiv">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                    <div class="card">
                        <div class="card-body mx-2">
                          <div class="text-center my-2">
                            <label>{{__('Booking Date')}}
                            <input type="text" readonly value="<?=date('Y-m-d')?>" id="booking_date_value" class="form-control">
                          </div>
                          
                    <ul class="nav nav-tabs">
                        <li><a style="border-radius:0px;width:100%" id="daynav" class="btn btn-default active" data-toggle="tab" href="#day">{{__('Day')}}</a></li>
                        <li><a style="border-radius:0px;width:100%" id="nightnav" class="btn btn-default" data-toggle="tab" href="#night">{{__('NIght')}}</a></li>
                    </ul>

                    <div class="tab-content">
                    
                    <div id="day" class="tab-pane active">
                        <form method="POST" action="{{ route('owner.bookingaction') }}" enctype="multipart/form-data" id="daynavform">
                            @csrf
                          <div class="mb-3 mt-4 cname_section row">
                           
                            <input type="hidden" name="customer_id" value="" id="customer_id">
                            <input type="hidden" name="slot_id" value="1">
                            <input type="hidden" name="pool_id" id="pool_id" value="">
                            <input type="hidden" name="booking_date" id="booking_date" value="">
                            <input type="hidden" name="booking_id" id="booking_id" value="">
                            
                           <div class="col-12 col-md-3 mt-1">
                                <select name="customer_id"  title="{{__('Search User By Name/Phone/CPR')}}" id="user_select" class="user_select form-control @error('customer_id') is-invalid @enderror">
                                </select>
                            </div>
                            <div class="col-4  col-md-3 mt-1">
                                <input type="text" required name="customer_name" id="customer_name"  class="form-control @error('customer_name') is-invalid @enderror"
                                placeholder="{{ __(' Name') }}"
                                value="{{    old('customer_name') }}"
                                >
                        
                                @error('customer_name')
                                <span class="error invalid-feedback">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="col-4 col-md-3 mt-1">
                                <input type="text" required  name="cpr" id="cpr"   class="form-control @error('cpr') is-invalid @enderror"
                                placeholder="{{ __('CPR') }}"
                                value="{{    old('cpr') }}"
                                 autocomplete="cpr" autofocus>
                        
                                @error('cpr')
                                <span class="error invalid-feedback">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>

                            <div class="col-4 col-md-3 mt-1">
                           
                                <input type="text" required name="phone" id="phone"  class="form-control @error('phone') is-invalid @enderror"
                                       placeholder="{{ __('phone') }}"
                                       value="{{    old('phone') }}"
                                        autocomplete="phone" autofocus>
                               
                                @error('phone')
                                <span class="error invalid-feedback">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="col-12 col-md-6 mt-1">
                                <select name="booking_type" id="booking_type" required class=" mr-1 form-control @error('booking_type') is-invalid @enderror">
                                <option disabled>{{__('Select Booking Type')}}</option>
                                <option value="rented">{{__('Rented')}} </option>
                                <option value="maintenance">{{__('Maintenance')}}</option>
                                <option value="private">{{__('Private')}}</option>

                                </select>
                            </div>  
                            <div class="col-12 col-md-6 mt-1">
                                <input type="text"  name="notes" id="notes" class="form-control @error('notes') is-invalid @enderror"
                                placeholder="{{ __('Notes') }}"
                                value="{{    old('notes') }}" >
                        
                                @error('notes')
                                <span class="error invalid-feedback">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="col-6 mt-1">
                                <input type="number"  name="advance_price" id="advance" class="form-control @error('advance_price') is-invalid @enderror"
                                placeholder="{{ __('Advance Price') }}"
                                value="{{    old('advance_price') }}" >
                        
                                @error('advance_price')
                                <span class="error invalid-feedback">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="col-6 mt-1">
                                <input type="text"  name="total_price" id="price" class="form-control @error('total_price') is-invalid @enderror"
                                placeholder="{{ __('Total Price') }}"
                                value="{{    old('total_price') }}" >
                        
                                @error('total_price')
                                <span class="error invalid-feedback">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <button type="submit" id="submit_btn" 
                                        class="btn btn-primary  full-width">{{ __('Save') }}
                                </button>
                            </div>
                            <div class="col-1"></div>
                            <div class="col-3">           
                                <button type="button"   onclick="resetForm('d')" 
                                        class="btn btn-warning full-width">{{ __('Cancel') }}
                                </button>
                            </div>           
                            <div class="col-1"></div>
                            <div class="col-3">
                                        <button type="button" id="delete_btn" 
                                        class="btn btn-danger  full-width">{{ __('Delete') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
                    <div id="night" class="tab-pane fade">
                        <form method="POST" action="{{ route('owner.bookingaction') }}" enctype="multipart/form-data" id="nightnavform">
                            @csrf
                         <div class="mb-3 mt-4 ncname_section row">

                            <input type="hidden" name="ncustomer_id" value="">
                            <input type="hidden" name="nslot_id" value="2">
                            <input type="hidden" name="npool_id" id="npool_id" value="">
                            <input type="hidden" name="nbooking_id" id="nbooking_id" value="">
                            <input type="hidden" name="nbooking_date" id="nbooking_date" value="">
                                
                           <div class="col-12 col-md-3 mt-1">
                                <select name="ncustomer_id" style="width:100%" title="{{__('Name/Phone/CPR')}}" id="nuser_select" class="user_select form-control @error('ncustomer_id') is-invalid @enderror">
                                </select>
                            </div>
                            <div class="col-4  col-md-3 mt-1">
                                <input type="text"  name="ncustomer_name" required id="ncustomer_name"  class="form-control @error('ncustomer_name') is-invalid @enderror"
                                placeholder="{{ __(' Name') }}"
                                value="{{    old('ncustomer_name') }}"
                                >
                        
                                @error('ncustomer_name')
                                <span class="error invalid-feedback">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="col-4  col-md-3 mt-1">
                                <input type="text" required name="ncpr" id="ncpr"  class="form-control @error('ncpr') is-invalid @enderror"
                                placeholder="{{ __('CPR') }}"
                                value="{{    old('ncpr') }}"
                                >
                        
                                @error('ncpr')
                                <span class="error invalid-feedback">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>

                            <div class="col-4 col-md-3 mt-1">
                           
                                <input type="text"  name="nphone" required id="nphone"  class="form-control @error('nphone') is-invalid @enderror"
                                       placeholder="{{ __('phone') }}"
                                       value="{{    old('nphone') }}"
                                       >
                               
                                @error('nphone')
                                <span class="error invalid-feedback">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="col-12 col-md-6 mt-1">
                                <select name="nbooking_type" id="nbooking_type" required class="form-control @error('nbooking_type') is-invalid @enderror">
                                <option disabled>{{__('Select Booking Type')}}</option>
                                <option value="rented">{{__('Rented')}} </option>
                                <option value="maintenance">{{__('Maintenance')}}</option>
                                <option value="private">{{__('Private')}}</option>

                                </select>
                            </div>
                            <div class="col-12 col-md-6 mt-1">
                                <input type="text"  name="nnotes" id="nnotes" class="form-control @error('nnotes') is-invalid @enderror"
                                placeholder="{{ __('Notes') }}"
                                value="{{    old('nnotes') }}" >
                        
                                @error('nnotes')
                                <span class="error invalid-feedback">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="col-6 mt-1">
                                <input type="number"  name="nadvance_price" id="nadvance" class="form-control @error('nadvance_price') is-invalid @enderror"
                                placeholder="{{ __('Advance Price') }}"
                                value="{{    old('nadvance_price') }}" >
                        
                                @error('nadvance_price')
                                <span class="error invalid-feedback">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="col-6 mt-1">
                                <input type="text"  name="ntotal_price" id="nprice" class="form-control @error('ntotal_price') is-invalid @enderror"
                                placeholder="{{ __('Total Price') }}"
                                value="{{    old('ntotal_price') }}" >
                        
                                @error('ntotal_price')
                                <span class="error invalid-feedback">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <button type="submit" id="submit_btn" 
                                        class="btn btn-primary full-width">{{ __('Save') }}
                                </button>
                            </div>
                            <div class="col-1"></div>
                            <div class="col-3">           
                                <button type="button" onclick="resetForm('n')"
                                        class="btn btn-warning full-width">{{ __('Cancel') }}
                                </button>
                            </div>           
                            <div class="col-1"></div>
                            <div class="col-3">
                                        <button type="button" id="delete_btn" 
                                        class="btn btn-danger  full-width">{{ __('Delete') }}</button>
                            </div>
                        </div>                    </form>
                    </div>
                    
                </div>


                        
                      
                      
                        
                        
                       
                        
                        
                       
                        
                              
                                  
                                    
                       
              
                       
                        </div>
                    
                </div>
            </div>
        </div>
    </div>
                
                <div class="collapse col-md-12 d-none" id="collapseExample">
                    <div class="card card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tr><th>{{__('Pool')}}</th>
                                    <th>{{__('Customer')}}</th>
                                    <th>{{__('Date')}}</th>
                                    <th>{{__('Slot')}}</th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <td id="pool_name"></td>
                                    <td id="customer_name1"></td>
                                    <td id="booking_date1"></td>
                                    <td id="slot"></td>
                                    <td id="actionbtn"></td>
                                </tr>
                            </table>
                        </div>
                      
                    </div>
                  </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
   




    


   
@endsection
@section('scripts')
<script>
    var pool_ids='';
    var price = '';
    var advance='';
    function resetForm(mode)
    {
        if(mode=='d')
        {
            resetDayFields();
        }
        else{
        resetNightFields();
        }
    }

    function showPoolData()
    {
       
    $("#owner_id").val($(this).data('owner_id'));
    $('.pool_id').each(function(){
      if($(this).is(":checked"))
      {
       pool_ids=($(this).val());
       price = $(this).attr('data-price');
       advance = $(this).attr('data-advance');
       $("#price").val(price);$("#nprice").val(price);
       $("#advance").val(advance);$("#nadvance").val(advance);
       $(this).parent().parent().parent().parent().parent().css("background-color","#00bc8c");
      }
      
      
    });

    

    $("#pool_select").val(pool_ids);
    $("#pool_select1").val(pool_ids);
    $.ajax( {
            url: "{{route('ajax.getPoolBookings')}}",
            data:  {
                pool_ids:pool_ids
            },
            success:function(result){
              
               loadCalendar(result);

            }
        }); 
    }
   function checkCustomerExists(name,cpr,phone,slot)
   {
    customer_id = $("#customer_id").val();
    $.ajax( {
            url: "{{route('ajax.check_user')}}",
            data:  {
                customer_name:name,
                cpr:cpr,
                phone:phone,
                mode:slot
            },
            success:function(result){
              if(result.status==1 && !customer_id)
              {
                if(slot=="day"){
                $("#customer_name").val('');$("#cpr").val('');$("#phone").val('');
                }else{$("#ncustomer_name").val('');$("#ncpr").val('');$("#nphone").val('');}
                alert('Customer exists already');
              }

            }
        }); 
   }
  $(document).ready(function(){
    
    $("#customer_name,#cpr,#phone").keyup(function(){
        customer_name = $("#customer_name").val();
        cpr =  $("#cpr").val();
        phone =   $("#phone").val();
        if($(this).val().trim().length>2){
        checkCustomerExists(customer_name,cpr,phone,'day');
        }
    });

    $("#ncustomer_name,#ncpr,#nphone").keyup(function(){
        customer_name = $("#ncustomer_name").val();
        cpr =  $("#ncpr").val();
        phone =   $("#nphone").val();
        if($(this).val().trim().length>2){
        checkCustomerExists(customer_name,cpr,phone,'night');
        }
    });


    $(".pool_card").click(function(){
        $(".pool_card").css("background-color","#FFF")
        $(this).css("background-color","#00bc8c");
    })
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
   
    // events from backend
    var events = <?php echo json_encode($formattedEvents) ?>;
    // load calendar
    
   showPoolData();
    // when pool is selected
   $(".pool_id").click(function(){
    showPoolData();
   });
   
   $('.select').select2({
    
   });
   // get user details on search
    $("#user_select").change(function(){
        user_id = $(this).val();
        $.ajax( {
            url: "{{route('ajax.getUserDetail')}}",
            data:  {
                user_id:user_id
            },
            success:function(result){
                
               if(result){
                $("#customer_id").val(result.id);
                $("#cpr").val(result.cpr);
                $("#phone").val(result.phone);
                console.log(result.customer_name+'123');
                $("#customer_name").val(result.name);
               }
                else{
                $("#customer_id").val(0);
              
                $("#customer_name").val();
              }

            }
        });
    });

    $("#nuser_select").change(function(){
        user_id = $(this).val();
        $.ajax( {
            url: "{{route('ajax.getUserDetail')}}",
            data:  {
                user_id:user_id
            },
            success:function(result){
              if(result){
                $("#ncustomer_id").val(result.id);
                $("#ncpr").val(result.cpr);
                $("#nphone").val(result.phone);
                $("#ncustomer_name").val(result.name);
              }
              else{
                $("#ncustomer_id").val(0);
                
              }

            }
        });
    });

    $(".user_select").select2({
    
        ajax: {
            url: "{{route('ajax.getUsers')}}",
            dataType: 'json',
            data: function (params) {
                var query = {
                    search: params.term,
                    type: 'user_search'
                }

                // Query parameters will be ?search=[term]&type=user_search
                return query;
            },
            processResults: function (data) {
                if(data.length==0)
                {
                
                }
                return {
                    results: data
                }
        },
        },
        cache: true,
        placeholder: '{{__("Phone/CPR")}}',
        minimumInputLength: 1
    });

  });

  function resetDayFields(info='')
  {
    $("#booking_type").val('rented');
    $("#customer_id").val(0);
    $("#customer_name").val('');
    $("#booking_id").val('');
    $("#pool_id").val(pool_ids);
    $("#notes").val('');
    $("#advance").val(advance);
    $("#total").val('');
    $("#cpr").val('');
    $("#phone").val('');
    $("#booking_date").val(info);                          
                                
  }
  function resetNightFields(info='')
  {
    $("#nbooking_type").val('rented');
                                
    $("#ncustomer_id").val(0);
    $("#ncustomer_name").val('');
    $("#nbooking_id").val(0);
    $("#npool_id").val(pool_ids);
    $("#nnotes").val('');
    $("#nadvance").val(advance);
    $("#ntotal").val('');
    $("#ncpr").val('');
    $("#nphone").val('');
    $("#nbooking_date").val(info);
  }

function dateClick1(info)
{


    $("#nbooking_date").val(info);
           $("#booking_date_value").val(info);
          $("#booking_date").val(info);
          var GivenDate = info;
          var CurrentDate = new Date();
          GivenDate = new Date(GivenDate);
          if(GivenDate > CurrentDate){
           
        }
        if(!pool_ids)
        {
            alert("Select a Pool to make a booking");
            return;
        }
        $("#pool_id").val(pool_ids);
        $("#npool_id").val(pool_ids); 
        $.ajax( {
            url: "{{route('get_schedule')}}",
            type:"POST",
            data:  {
                _token:"{{csrf_token()}}",
                pool_id:pool_ids,
                date:info
            },
            success:function(result){
               
                
                    var disable = false;
                    $("#submit_btn").attr("disabled",true);  
                    if(result.slots.unavailable.includes(info)){
                       // alert("No Time Available");
                        $("#daynav").click();
                        }
                        else if(result.slots.daysbooked.includes(info)){
                            $("#daynav").click();
                            //$("#daynavform").reset();
                            
                        }
                        else if(result.slots.nightsbooked.includes(info)){
                            $("#nightnav").click();
                            //$("#nightnavform").reset();
                        }
                        else{
                            $("#daynav").click();   
                        }
                        var bookings = result.bookings;
                        if(bookings.length==2)
                        {
                                for(i=0;i<bookings.length;i++)
                            {
                                if(bookings[i].slot_id==1)
                                {
                                    $("#booking_type").val(bookings[i].booking_type);
                                    booking_id = bookings[i].booking_id;
                                    $("#customer_id").val(bookings[i].customer_id);
                                    $("#customer_name").val(bookings[i].customer_name);
                                    $("#booking_id").val(bookings[i].booking_id);
                                    $("#pool_id").val(pool_ids);
                                    $("#notes").val(bookings[i].notes);
                                    $("#advance").val(bookings[i].advance_price);
                                    $("#total_price").val(bookings[i].total_price);
                                    $("#cpr").val(bookings[i].cpr);
                                    $("#phone").val(bookings[i].phone);
                                    $("#booking_date").val(info);
                                // $("#notes").val(bookings[i].notes);
                                }
                                if(bookings[i].slot_id==2)
                                {
                                    $("#nbooking_type").val(bookings[i].booking_type);
                                    nbooking_id = bookings[i].booking_id;
                                    ncustomer_id = bookings[i].customer_id;
                                    $("#ncustomer_id").val(bookings[i].customer_id);
                                    $("#ncustomer_name").val(bookings[i].customer_name);
                                $("#nbooking_id").val(bookings[i].booking_id);
                                    $("#npool_id").val(pool_ids);
                                    $("#nnotes").val(bookings[i].notes);
                                    $("#nadvance").val(bookings[i].advance_price);
                                    $("#ntotal").val(bookings[i].total_price);
                                    $("#ncpr").val(bookings[i].cpr);
                                    $("#nphone").val(bookings[i].phone);
                                    $("#nbooking_date").val(info);
                                }
                            }  
                        }
                        else if(bookings.length==1){
                      
                            for(i=0;i<bookings.length;i++)
                            {
                            if(bookings[i].slot_id==1)
                            {
                                $("#booking_type").val(bookings[i].booking_type);
                                booking_id = bookings[i].booking_id;
                                $("#customer_id").val(bookings[i].customer_id);
                                $("#booking_id").val(bookings[i].booking_id);
                                $("#customer_name").val(bookings[i].customer_name);
                                $("#pool_id").val(pool_ids);
                                $("#notes").val(bookings[i].notes);
                                $("#advance").val(bookings[i].advance_price);
                                $("#total").val(bookings[i].total_price);
                                $("#cpr").val(bookings[i].cpr);
                                $("#phone").val(bookings[i].phone);
                                $("#booking_date").val(info);
                               // $("#notes").val(bookings[i].notes);
                            }
                            else 
                            {
                               resetDayFields(info);
                            }
                             if(bookings[i].slot_id==2)
                            {
                                $("#nbooking_type").val(bookings[i].booking_type);
                                nbooking_id = bookings[i].booking_id;
                                ncustomer_id = bookings[i].customer_id;
                                $("#ncustomer_id").val(bookings[i].customer_id);
                                $("#ncustomer_name").val(bookings[i].customer_name);
                               $("#nbooking_id").val(bookings[i].booking_id);
                                $("#npool_id").val(pool_ids);
                                $("#nnotes").val(bookings[i].notes);
                                $("#nadvance").val(bookings[i].advance_price);
                                $("#ntotal").val(bookings[i].total_price);
                                $("#ncpr").val(bookings[i].cpr);
                                $("#nphone").val(bookings[i].phone);
                                $("#nbooking_date").val(info);
                            }
                            else{
                               resetNightFields(info);
                            }
                        }
                       
                    }
                       else{
                       
                        
                            //reset day tab input fields
                            resetDayFields(info);
                            //reset night tab input fields    
                            resetNightFields(info);
                        
                        $("#booking_date").val(info);
                        $("#nbooking_date").val(info);
                       
                       }
                       $("#npool_id").val(pool_ids);
                        $("#pool_id").val(pool_ids);
                        
                        
                        
                    
                
            
             
            if(!disable)
            {
                $("#submit_btn").removeAttr("disabled");
            }
          
            
            
        }
        });



        $('html, body').animate({
        scrollTop: $("#bookingdiv").offset().top
    }, 1000);

          
    // change the day's background color just for fun
    //info.dayEl.style.backgroundColor = 'red';
}



  // function loading the calendar
function loadCalendar(events) {
  $(".fc-daygrid-day-frame").css("background","#FFF");
    const calendarEl = document.getElementById('calendar')
    const calendar = new Calendar(calendarEl, {
      initialView: 'dayGridMonth',height: 250,
     
     // locale: deLocale,
     // plugins: ['interaction', 'dayGrid', 'timeGrid', 'list','rrule'],
     headerToolbar: { center: 'dayGridMonth,timeGridWeek' },
  
    events:  events,

    eventDidMount: function (info) {
        var date =info.event.extendedProps.booking_date;
        var slots = info.event.extendedProps.slots;
        var parent = $(info.el).parent().parent().parent();
        if(slots){
            console.log(date);
            if(slots.unavailable.includes(date)){
            parent.css('backgroundColor','#fb3838be');
        }
        else if(slots.daysbooked.includes(date)){
             parent.css('backgroundColor','#ffb52cc4');
             
        }
        else if(slots.nightsbooked.includes(date)){
            parent.css('backgroundColor','#5353ff');
            
        }
      
        else{
            parent.css('backgroundColor','#FFF');
        }
        }
        else{
     
            parent.css('backgroundColor','#FFF');
        }
    
      
        },
        
        
        eventClick: function(info) {
            
      var eventObj = info.event;
      info=eventObj.extendedProps.booking_date;
     dateClick1(info);
    } 
    ,

        dateClick: function(info) {
          resetDayFields(info.dateStr);
          resetNightFields(info.dateStr);
          dateClick1(info.dateStr);
  }
    })
    calendar.render()
  }
  
</script>
@endsection

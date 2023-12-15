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
         
          <div class="slider">
            @foreach($pools as $pool)
            
         <div class="col-md-3">
            <div class="card">
                <div class="card-body p-0">
                    <div style="slider" >
                        
                
                        <img src=" {{ asset('uploads/'.$pool->images[0]->pool_image) }} " width="100%" class="img img-responsive" height="175px">
                        
                             
                    </div>
                    <div class="px-3 py-3 ">
                    <h4 class="text-center">
                       <label> {{ $pool->pool_name }}
                        <input type="radio" name="pool_id" data-owner_id="{{ $pool->owner_id }}" value="{{ $pool->id }}" class="pool_id" class="form-control"> 
                       </label>
                        <input type="hidden" id="owner_id" value="{{ $pool->owner_id }}">  
                    </h4>
                   
                   


            
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
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
    <!-- Booking modal -->


<!-- Modal -->
<div class="modal fade" id="bookingModal" tabindex="-1" role="dialog" aria-labelledby="bookingModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content modal-lg">
      <div class="modal-header">
        <h5 class="modal-title" id="bookingModalLabel">Create Booking</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close_modal">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('owner.bookingaction') }}" enctype="multipart/form-data">
          @csrf
          
          <h3>Customer info</h3>
          <hr>
          <input type="hidden" name="customer_id" id="customer_id" value="">
          <div class="mb-3 cname_section">
              <label>Customer Name <i class="fa fa-plus" id="new_customer"> </i></label>
              <select name="customer_name" id="user_select" class="user_select form-control @error('customer_id') is-invalid @enderror">
              </select>
              <input type="text" name="name" id="customer_name" class="mt-3 form-control @error('name') is-invalid @enderror"
              
              
                placeholder="Customer Name" value="" >
             
              @error('customer_id')
              <span class="error invalid-feedback">
                  {{ $message }}
              </span>
              @enderror
          </div>
        
        
          <div class="mb-3">
              <label>CPR </label>
              <input type="number" min=0 step=0.1 name="cpr" id="cpr" class="form-control @error('cpr') is-invalid @enderror"
                     placeholder="{{ __('CPR') }}"
                     value="{{    old('cpr') }}"
                      autocomplete="cpr" autofocus>
             
              @error('cpr')
              <span class="error invalid-feedback">
                  {{ $message }}
              </span>
              @enderror
          </div>
          
          <div class="mb-3 row">
              <div class="col-md-12">
              <label>Phone Number</label>
              <input type="number" min=0 step=0.1 name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror"
                     placeholder="{{ __('phone') }}"
                     value="{{    old('phone') }}"
                      autocomplete="phone" autofocus>
             
              @error('phone')
              <span class="error invalid-feedback">
                  {{ $message }}
              </span>
              @enderror
          </div>
 
          </div>
          
          <h3>Booking info</h3>
          <hr>
          <div class=" mb-3 row">
              <div class="col-md-6">
              <label>Select Pool</label>
              <select name="pool_id" id ="pool_select" class="select" style="width:100%;">
                      @foreach ($pools as $pool)
                          <option @if(old('pool_id')) selected @endif value="{{$pool->id}}">{{$pool->short_name}}</option>
                      @endforeach
              </select>
              @error('pool_id')
              <span class="error invalid-feedback">
                  {{ $message }}
              </span>
              @enderror
          </div>
          <div class="col-md-6">

              
                  <label>Date</label>
                  <input type="date" name="booking_date" class="form-control @error('booking_date') is-invalid @enderror"
                         placeholder="{{ __('booking_date') }}"
                         value="{{    old('booking_date') }}" 
                         required id="booking_date">
                 
                  @error('booking_date')
                  <span class="error invalid-feedback">
                      {{ $message }}
                  </span>
                  @enderror
             
          </div>
          </div>
          <!-- Day/Night -->
              <div class="form-group row">
                  <div class="col-md-6">
                      <label>
                          Day <input type="radio" name="slot_id" class="" value="1">
                      </label>
                  </div>
                  <div class="col-md-6">
                      <label>
                          Night <input type="radio" name="slot_id" class="" value="2">
                      </label>
                  </div>
                  </div>
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
                                  <input type="text" name="iban" id="iban_field" readonly class="form-control" placeholder="IBAN ">
                                  <label for="" class="form__label">IBAN <span id="copy_iban" class="mt-2 btn btn-sm btn-success d-none">Copy IBAN</span></span></label>
                              </div>
                          </div>
                      </div>
                      <div class="row d-none" id="iban_show">
                          <div class="col-12">
                              <div class="form__div">
                                  <input type="text" name="iban" class="form-control" placeholder="IBAN ">
                                  <label for="" class="form__label">IBAN</label>
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
                                  <input type="text" class="form-control" placeholder=" " name="">
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
                                  <input type="text" class="form-control" placeholder=" ">
                                  <label for="" class="form__label">name on the card</label>
                              </div>
                          </div>
                          
                      </div>
         

          <div class="row">
              <div class="col-12">
                  <button type="submit"
                          class="btn btn-primary btn-block">{{ __('Submit') }}</button>
              </div>
          </div>
      </form>
      </div>
      
    </div>
  </div>
</div>
    <!-- /Booking modal -->
@endsection
@section('scripts')
<script>
  $(document).ready(function(){
    $.fn.modal.Constructor.prototype._enforceFocus = function() {};
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
    //copy iban
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
    // events from backend
    var events = <?php echo json_encode($formattedEvents) ?>;
    // load calendar
    loadCalendar(events);
   
    // when pool is selected
   $(".pool_id").click(function(){
    pool_ids = '';
    $("#owner_id").val($(this).data('owner_id'));
    $('.pool_id').each(function(){
      if($(this).is(":checked"))
      {
       pool_ids=($(this).val());
      }
      else{
        
       //var index =pool_ids.indexOf($(this).val());
        //var x=pool_ids.splice(index, 1);
        //consol.log(pool_ids);
      }
      
    });
    $("#pool_select").val(pool_ids);
    $.ajax( {
            url: "{{route('ajax.getPoolBookings')}}",
            data:  {
                pool_ids:pool_ids
            },
            success:function(result){
              
               loadCalendar(result);

            }
        });
   });

   $('.select').select2({
   dropdownParent: "#bookingModal"
   });
    $("#user_select").change(function(){
        user_id = $(this).val();
        $.ajax( {
            url: "{{route('ajax.getUserDetail')}}",
            data:  {
                user_id:user_id
            },
            success:function(result){
              
                $("#customer_id").val(result.id);
                $("#cpr").val(result.cpr);
                $("#phone").val(result.phone);
                $("#email").val(result.email);

            }
        });
    });
    //close booking modal
    $("#close_modal").click(function(){
      $("#bookingModal").modal('hide');
    });
    //show new customer name
    $("#new_customer").click(function(){
        $("#customer_name").show();
        $("#user_select,.cname_section .select2").hide();
    });
    $("#customer_name").hide();
    //change the payment mode
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
    $(".user_select").select2({
      dropdownParent: "#bookingModal",
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
                   $("#customer_name").show();
                }
                return {
                    results: data
                }
        },
        },
        cache: true,
        placeholder: 'Search for a user...',
        minimumInputLength: 1
    });

  });

  // function loading the calendar
function loadCalendar(events) {
  $(".fc-daygrid-day-frame").css("background","#FFF");
    const calendarEl = document.getElementById('calendar')
    const calendar = new Calendar(calendarEl, {
      initialView: 'dayGridMonth',
     
     // locale: deLocale,
     // plugins: ['interaction', 'dayGrid', 'timeGrid', 'list','rrule'],
     headerToolbar: { center: 'dayGridMonth,timeGridWeek' },
  
    events:  events,

    eventDidMount: function (info) {
      
      if(info.event.extendedProps.slots){
        console.log(info.event.extendedProps.slots);
      if(info.event.extendedProps.slots.includes("Day") && info.event.extendedProps.slots.includes("Night")){
      $(info.el).parent().parent().parent().css('backgroundColor','red');
      }
      else if(info.event.extendedProps.slots.includes("Day")){
        $(info.el).parent().parent().parent().css('backgroundColor','brown');
      }
      else if(info.event.extendedProps.slots.includes("Night")){
        $(info.el).parent().parent().parent().css('backgroundColor','blue');
      }
      else{
        $(info.el).parent().parent().parent().css('backgroundColor','#FFF');
      }
    }
    else{
     // $(".fc-daygrid-day-frame").css("background","#FFF");
        $(info.el).parent().parent().parent().css('backgroundColor','#FFF');
      }
    
            $(info.el).tooltip({
               
                title: info.event.extendedProps.customer_name+ ' Booked '+ info.event.extendedProps.pool_name+"  " + info.event.extendedProps.slot,
                container: 'body',
                delay: { "show": 50, "hide": 50 },
                placement:'top',
                trigger:'click'
            });
        },
        dateClick: function(info) {
          $("#booking_date").val(info.dateStr);
          console.log('Clicked on: ' + info.dateStr);
          $("#bookingModal").modal('show');
    // change the day's background color just for fun
    //info.dayEl.style.backgroundColor = 'red';
  }
    })
    calendar.render()
  }
</script>
@endsection

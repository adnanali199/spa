@extends('layouts.admin')
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
          <div class="row">
            <div class="col-md-2">
              <a href="{{route('admin.owners')}}">
              <div class="card">
                <div class="card-body text-center">
                  <h6 class="bg-pink py-2"> Owners</h6>
                  <hr>
                  <h4>{{ $total_owners }}</h4>
                </div>
              </div>
            </a>
            </div>
            <div class="col-md-2">
              <a href="{{route('admin.users')}}">
              <div class="card">
                <div class="card-body text-center">
                  <h6 class="bg-primary py-2">Users</h6>
                  <hr>
                  <h4>{{ $total_users }}</h4>
                </div>
              </div>
            </a>
            </div>
            <div class="col-md-2">
              <div class="card">
                <div class="card-body text-center">
                  <h6 class="bg-success py-2">Bookings</h6><hr>
                  <h4>{{ $total_bookings }}</h4>
                </div>
              </div>
            </div>
            <div class="col-md-2">
              <div class="card">
                <div class="card-body text-center">
                  <h6 class="bg-info py-2"> Pools</h6>
                  <hr>
                  <h4>{{ $total_pools }}</h4>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <a href="{{route('admin.owners')}}">
              <div class="card">
                <div class="card-body text-center">
                  <h6 class="bg-warning py-2 px-2">Pending owners</h6>
                  <hr>
                  <h4>{{ $total_users_pa }}</h4>
                </div>
              </div>
            </a>
            </div>
          </div>
          <!--Owner Pools list -->
          
          <div class="row d-none">
            @foreach($pools as $pool)
            
         <div class="col-sm-3">
            <div class="card">
                <div class="card-body p-0">
                    <div style="">
                        @foreach($pool->images as $image)
                
                        <img src=" {{ asset('uploads/'.$image->pool_image) }} " width="100%" class="img img-responsive" height="175px">
                        
                        @endforeach       
                    </div>
                    <div class="px-3 py-3 ">
                    <h4 class="text-center">{{ $pool->pool_name }}</h4>
                    <small>{{ $pool->short_name }}</small>
                    <p class="text-right">{{ $pool->price }}</p>


            
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer clearfix">
                        <input type="radio" name="pool_id" data-owner_id="{{ $pool->owner_id }}" value="{{ $pool->id }}" class="pool_id" class="form-control"> 
                        <input type="hidden" id="owner_id" value="">    
                </div>
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
   



@endsection
@section('scripts')
<script>
  var events = <?php echo json_encode($formattedEvents) ?>;
  $(document).ready(function(){
    loadCalendar(events);

    // when pool is selected
   $(".pool_id").click(function(){
    pool_ids = '';
    //$("#owner_id").val($(this).data('owner_id'));
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
        $(info.el).parent().parent().parent().css('backgroundColor','#434333');
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

@extends('layouts.owner')
@section('styles')
<style>
.fc .fc-highlight {
    background: #20c997!important;
  }
  .fc-h-event{
    border:none!important;
  }
  </style>
@endsection
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6 col-md-12">
                <h4 class="m-0"><i class="fa fa-plus"></i>
                {{ __('Pool Schedule for ')   }}{{$pool->short_name}}
                     </h4>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<!-- Main content -->
<div class="content">
    <div class="container">
        <div class="row">
          
            <div class="col-lg-12">
              <div class="text-right">
              
              </div>
                <div class="alert alert-info d-none">
                 {{__('Pool Schedule')}}
                </div>
                <div class="row">
             
                
             <div class="col-md-12">
                
                        <form method="POST" action="{{ route('owner.scheduleAction',$pool->id??0) }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="pool_id" value="{{$pool->id}}">
                            <input type="hidden" name="available_date" id="available_date" value="">
                            <div class="mb-3">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div id="calendar"></div>
                                        </div>
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
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
</div>
@endsection
@section('scripts')

<script>
    var selected =[];
    function getDatesBetween(startDate, endDate) {
  const currentDate = new Date(startDate.getTime());
  const dates = [];
  while (currentDate < endDate) {
    d=new Date(currentDate);
    month = d.getMonth();
    month++;
    d1=d.getFullYear()+"-"+month+"-"+("0"+d.getDate()).slice(-2);
    selected.push(d1);
    currentDate.setDate(currentDate.getDate() + 1);
  }
  return dates;
}

    $(document).ready(function(){
       var events= <?php echo json_encode($event) ?>;
        loadCalendar(events);
    });
    
    // function loading the calendar
function loadCalendar(event) {
 
    const calendarEl = document.getElementById('calendar')
    const calendar = new Calendar(calendarEl, {
      initialView: 'dayGridMonth',
    
     // locale: deLocale,
     // plugins: ['interaction', 'dayGrid', 'timeGrid', 'list','rrule'],
     headerToolbar: { center: 'dayGridMonth,timeGridWeek' },
        dateClick: function(info) {
          $("#booking_date").val(info.dateStr);
          console.log('Clicked on: ' + info.dateStr);
         
      
         info.dayEl.style.backgroundColor = '#20c997';
        var available_date = $("#available_date").val();
        
         
            index = selected.indexOf(info.dateStr);
            if(index!=-1)
            {
                selected.splice(index, 1);
                info.dayEl.style.backgroundColor = '#FFF';
            }
            else{
            selected.push(info.dateStr);
            }
         
         console.log(selected);
        // $("#available_date").val(selected);
  },
  selectable: true,
  events:event,
  select:function(info){
    const date1 = new Date(info.startStr);
    const date2 = new Date(info.endStr);
    let allDates = getDatesBetween(date1, date2);
    $("#available_date").val(selected);
  },
  eventDidMount: function(info) {console.log(info);$(info.el).parent().parent().parent().css('background',"#20c997");}
    })
    calendar.render()
  }

  </script>
@endsection
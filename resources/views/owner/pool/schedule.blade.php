@extends('layouts.owner')
@section('styles')
<style>
.fc .fc-highlight {
    background: #20c997!important;
  }
  .fc-h-event{
    border:none!important;
  }
  #calendar{
    height:550px;
  }
  .fc-day{
    position: relative!important;
  }
  .selected{
    position: absolute;
    top:0%;
    z-index: 100000000000000;
    width:100%;
    height:100%;
   
  }
  </style>
@endsection
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="">
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
    <div class="">
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
                            <input type="hidden" name="available_date" id="available_date" value="{{ json_encode($available_date) }}">
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
                                    <button type="submit" onclick="submit()"
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
    var selected_data = <?php echo json_encode($available_date) ?>;
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
      console.log(selected_data);
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
            cell = $(info.dayEl);
            var id = info.dateStr;
            $("#booking_date").val(info.dateStr);
            var available_date = $("#available_date").val();
            index = selected.indexOf(info.dateStr);
            var append = '<div class="selected" id="'+id+'"><label> D <input data-mode="day" data-date="'+id+'" id="day_'+id+'" type="checkbox" class="checkbox" name="day[]" value="'+id+'" checked /> </label> <label> N <input data-date="'+id+'" data-mode="night" name="night[]" id="night_'+id+'"  type="checkbox" class="checkbox" value="'+id+'" checked /> </label> </div>';
            $('#'+id +" .checkbox").change(function() 
            {
              var mode = $(this).attr('data-mode');
              var date = $(this).attr('data-date');
             if($(this).is(":checked"))
             {
              for(i=0;i<selected_data.length;i++)
              {
                if(selected_data[i].date_available==date)
                {
                  if(mode=="day"){
                  selected_data[i].day =1;
                  }
                  else{
                    selected_data[i].night =1;
                  }
                }
                
              }
             }
             else{
              
              for(i=0;i<selected_data.length;i++)
              {
                if(selected_data[i].date_available==date)
                {
                  if(mode=="day"){
                  selected_data[i].day =0;
                  }
                  else{
                    selected_data[i].night =0;
                  }
                }
                
              }
             }
             $("#available_date").val(JSON.stringify(selected_data));
             console.log(selected_data);
              });
           
            if(index!=-1)
            {
               // selected.splice(index, 1);
               // $('#'+id).remove();
            }
            else{
              var data={
                'date_available':info.dateStr,
                'day':1,
                'night':1
              }
            selected.push(info.dateStr);
            selected_data.push(data);
            console.log(selected_data);
            cell.append(append);
             
          }
            
         $("#available_date").val(JSON.stringify(selected_data));
         return false;
  },

  events:event,
 

  eventDidMount: function(info) {
   //$(info.el).parent().parent().parent().css('background',"#20c997");
   //console.log(info);
   var id = info.event.extendedProps.date_available; 
   var append = '<div class="selected" >';
        if(info.event.extendedProps.slot_id==1){
    append +='<label> D <input  type="checkbox" class="checkbox" name="day[]" value="'+id+'" checked />';
         } 
        
          if(info.event.extendedProps.slot_id==2){
            append+='</label> <label> N <input  name="night[]"  type="checkbox" class="checkbox" value="'+id+'"  checked /> </label>';
         }
         append+=' </div>';
      $(info.el).append(append);    
    
},
/*validRange: function (nowDate) {
  return {
    start: nowDate
  };
},*/
    });
    calendar.render()
  }


  </script>
@endsection
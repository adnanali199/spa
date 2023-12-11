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
                            <input type="hidden" name="available_date" id="available_date" value="{{ implode(",",$available_date) }}">
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
    var selected_data = [];
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
            cell = $(info.dayEl);
            var id = info.dateStr;
            $("#booking_date").val(info.dateStr);
            var available_date = $("#available_date").val();
            index = selected.indexOf(info.dateStr);
            var append = '<div class="selected" id="'+id+'"><label> D <input data-date="'+id+'" id="day_'+id+'" type="checkbox" class="checkbox" name="day[]" value="'+id+'" checked /> </label> <label> N <input data-date="'+id+'" name="night[]" id="night_'+id+'"  type="checkbox" class="checkbox" value="'+id+'" checked /> </label> </div>';
            $('#'+id +" .checkbox").change(function() 
            {
               
                var slot = $(this).val(); 
                var data_obj = {id:id,slot:slot};
                if($(this).is(":checked"))
                 {       
                
                var index = selected_data.indexOf(data_obj); 
                const newArr = arr.filter(object => {
                                return object.id !== 3;
                                });           
                        if (index > -1) {
                            selected_data.splice(index, 1);
                        }
                        else{
                            selected_data.push({data_obj});
                        }
                      }   
     	        else{
                    var index = selected_data.indexOf({id,slot});            
                        if (index > -1) {
                            selected_data.splice(index, 1);
                        }
                      }  
                      console.log(selected_data);
              });
           
            if(index!=-1)
            {
               // selected.splice(index, 1);
               // $('#'+id).remove();
            }
            else{
            selected.push(info.dateStr);
            console.log(selected);
            cell.append(append);
            }
            
         $("#available_date").val(selected);
         return false;
  },
  selectable: false,
  events:event,
  validRange: function (nowDate) {
  return {
    start: nowDate
  };
},
  select:function(info){
    const date1 = new Date(info.startStr);
    const date2 = new Date(info.endStr);
    let allDates = getDatesBetween(date1, date2);
    $("#available_date").val(selected);
  },
  eventDidMount: function(info) {
  //  $(info.el).parent().parent().parent().css('background',"#20c997");
   console.log(info);
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
 
    });
    calendar.render()
  }


  </script>
@endsection
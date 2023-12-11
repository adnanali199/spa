@extends('layouts.owner')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 col-md-12">
                    <h1 class="m-0">{{ __('Bookings') }}
                        <a href="{{route('owner.add-booking')}}" class="btn btn-info float-right clearfix"> <i class="fa fa-plus"></i> {{ __('New Booking')}}</a>
                    </h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                  <div class="text-right">
                  
                  </div>
                    <div class="alert alert-info d-none">
                      Bookings List
                    </div>
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table  data-table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Customer Name</th>
                                        <th>Pool</th>
                                        <th>Booking Date</th>
                                        <th>Day/Night</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                   
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
<script type="text/javascript">
    function approve(ele)
    {
        var booking_id = $(ele).data('id');
        var mode = $(ele).data('mode')
        $.ajax( {
            type:'post',
            url: "{{route('ajax.changeBookingStatus')}}",
            data:  {
               _token:"{{ csrf_token()  }}", booking_id:booking_id,mode:mode
            },
            success:function(result){
                if(result.response==1)
                {
                    alert("Booking Status Updated");
                    location.reload();
                }
            }
        });
    }
    
    $(function () {
      var table = $('.data-table').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('owner.booking.list') }}",
          columns: [
              {data: 'id', name: 'id'},
              {data: 'name', name: 'name'},
              {data: 'pool_name', name: 'pool_name'},
              {data: 'booking_date', name: 'booking_date'},
              {data: 'slot', name: 'slot'},
              {data: 'status', name: 'status'},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });
    });
  </script>
  @endsection
@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 col-md-12">
                   
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
                      Owners List
                    </div>
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table  data-table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>CPR</th>
                                        <th>IBAN</th>
                                        <th>Contract No.</th>
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
        var user_id = $(ele).data('id');
        var mode = $(ele).data('mode')
        $.ajax( {
            type:'post',
            url: "{{route('ajax.changeUserStatus')}}",
            data:  {
               _token:"{{ csrf_token()  }}", user_id:user_id,mode:mode
            },
            success:function(result){
                if(result.response==1)
                {
                    alert("User Status Updated");
                    location.reload();
                }
            }
        });
    }
    
    $(function () {
      var table = $('.data-table').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('admin.owner.list') }}",
          columns: [
              {data: 'id', name: 'id'},
              {data: 'name', name: 'name'},
              {data: 'email', name: 'email'},
              {data: 'phone', name: 'phone'},
              {data: 'cpr', name: 'cpr'},
              {data: 'iban', name: 'iban'},
              {data: 'contract_no', name: 'contract_no'},
              {data: 'status', name: 'status'},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });
    });
  </script>
  @endsection
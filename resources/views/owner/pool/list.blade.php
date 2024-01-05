@extends('layouts.owner')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="">
            <div class="row mb-2">
                <div class="col-sm-6 col-md-12">
                    <h1 class="m-0">{{ __('Pooles') }}
                        <a href="{{route('owner.add-pool')}}" class="btn btn-info float-right clearfix"> <i class="fa fa-plus"></i> {{ __('New Pool')}}</a>
                    </h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="">
            <div class="row">
                <div class="col-lg-12">
                  <div class="text-right">
                  
                  </div>
                    <div class="alert alert-info d-none">
                      Pools List
                    </div>
                    <div class="row">
                    @foreach($pools as $pool)
                    
                 <div class="col-sm-3">
                    <div class="card">
                        <div class="card-body p-0">
                           
                            <div class="px-5 py-3 ">
                                <div class="row">
                                    <div class="col-12 col-xs-12 col-md-12 text-center"><h5>{{ $pool->pool_name }}</h5></div>
                                     </div>
                            
                           

                    
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer clearfix">
                                               <a href="{{ route('owner.add-pool',$pool->id)}}" class="btn btn-sm btn-info" title="Edit"><i class="fa fa-edit"></i></a> 
                                               <a href="#" data-href="{{ route('owner.pools.delete',$pool->id)}}" class="btn btn-sm btn-danger delete" title="Delete"><i class="fa fa-trash"></i></a>
                                               <a href="{{ route('owner.pools.schedule',$pool->id)}}" class="btn btn-sm btn-success d-none" title="Schedule"><i class="fa fa-calendar"></i></a> 
      
                        </div>
                    </div>
                </div>
                    @endforeach
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
    $(document).ready(function(){
        $(".delete").click(function(){
            var href = $(this).data('href');
        Swal.fire({
  title: "Are you sure?",
  text: "You won't be able to revert this!",
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: "#3085d6",
  cancelButtonColor: "#d33",
  confirmButtonText: "Yes, delete it!"
}).then((result) => {
  if (result.isConfirmed) {
    Swal.fire({
      title: "Deleted!",
      text: "Your file has been deleted.",
      icon: "success"
    });
    window.location.href=href;
  }
});
        });
    });
</script>
@endsection
@extends('layouts.owner')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
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
        <div class="container-fluid">
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
                            <div style="">
                                @foreach($pool->images as $image)
                        
                                <img src=" {{ asset('uploads/'.$image->pool_image) }} " width="100%" class="img img-responsive" height="175px">
                                
                                @endforeach       
                            </div>
                            <div class="px-3 py-3 ">
                            <h4 class="text-center">{{ $pool->pool_name }}</h4>
                            <div class="row">
                                <div class="col-md-6">Rooms: {{  $pool->no_of_rooms }}</div>
                                <div class="col-md-6">Normal Price: $ {{ $pool->price }}</div>
                                <div class="col-md-6">Pool Size(feet) : {{$pool->length}} by {{$pool->width}} </div>
                                <div class="col-md-6">Land Size(feet) : {{$pool->land_length}} by {{$pool->land_width}} </div>
                            </div>
                            
                           

                    
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer clearfix">
                                               <a href="{{ route('owner.add-pool',$pool->id)}}" class="btn btn-sm btn-info" title="Edit"><i class="fa fa-edit"></i></a> 
                                               <a href="{{ route('owner.pools.delete',$pool->id)}}" class="btn btn-sm btn-danger" title="Delete"><i class="fa fa-trash"></i></a>
                                               <a href="{{ route('owner.pools.schedule',$pool->id)}}" class="btn btn-sm btn-success" title="Schedule"><i class="fa fa-calendar"></i></a> 
      
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
        alert();
    });
</script>
@endsection
@extends('layouts.admin')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6 col-md-12">
                <h4 class="m-0"><i class="fa fa-plus"></i>
                {{ __('Features') }}
                     </h4>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
              <div class="text-right">
              
              </div>
                <div class="alert alert-info d-none">
                 {{__('Feature List')}}
                </div>
                <div class="row">
             
                
             <div class="col-md-12">
                
                
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.featuresaction',($feature)?$feature->id:'') }}" enctype="multipart/form-data">
                            @csrf
                            
                           
                            
                            <div class="mb-3">
                                <label>{{__('Feature Name')}}</label>
                                
                                <input type="text" name="feature_title" id="feature_title" class="mt-3 form-control @error('feature_title') is-invalid @enderror"
                                
                                value="{{    ($feature)?$feature->feature_title:'' }}"
                                  placeholder="{{__('Feature Name')}}" value="" >
                               
                               
                            </div>
                           
                                    <div class="mb-3">
                                        <label>{{__('Feature Icon')}}</label>
                                        <input type="file" name="feature_icon" class="form-control">
                                        @if(($feature) && $feature->feature_icon)
                                        <img src = "{{ asset('icons/')."/".$feature->feature_icon }}" width="80px" class="img img-thumbnail img-rounded img-circle">
                                        @endif
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-sm btn-success add_feature"><i class="fa fa-plus"> </i> Submit</submit>
                                    </div>
                               
                          
                          
                           
                           
                            
                            
                           
                          
                           
                                   
                                       
                           
                
                           
                        </form>
                </div>
                    <!-- /.card-body -->

                    <div class="card-footer clearfix">
                        
                    </div>
                </div>
                
                
                
                
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                        <table class=" table-stripped table">
                            <tr>
                                <th>#</th>
                                <th>{{__('Feature Name')}}</th>
                               
                                <th>{{__('Feature icon')}}</th>
                                <th></th>
                            </tr>
                            @foreach($features as $feature)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $feature->feature_title }}</td>
                              
                                <td><img src = "{{ asset('icons/')."/".$feature->feature_icon }}" width="60px" class="img img-thumbnail img-rounded img-circle"></td>
                                <td>
                                    <a href="{{route('admin.features',$feature->id)}}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                                    <a href="{{route('admin.features.delete',$feature->id)}}" class="btn btn-sm btn-danger "><i class="fa fa-trash"></i></a></td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                    </div>
                </div>    
                
            
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
$(document).ready(function(){
   
});




</script>

@endsection
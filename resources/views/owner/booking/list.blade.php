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
        <div class="container">
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
<!-- Modal -->
<div class="modal fade" id="bookingModal" tabindex="-1" role="dialog" aria-labelledby="bookingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content modal-lg">
        <div class="modal-header">
          <h5 class="modal-title" id="bookingModalLabel">Edit Booking</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close_modal">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{ route('owner.bookingaction') }}" enctype="multipart/form-data">
            @csrf
            
           
            <input type="hidden" name="customer_id" id="customer_id" value="">
            <div class="mb-1 cname_section">
                <label>Customer Name <i class="fa fa-plus" id="new_customer"> </i></label>
                <select name="customer_name" id="user_select" class="user_select form-control @error('customer_id') is-invalid @enderror">
                </select>
                @error('customer_id')
                <span class="error invalid-feedback">
                    {{ $message }}
                </span>
                @enderror
                <div>{{ $booking->customer_name??'' }}</div>
            </div>
          
          
            <div class="mb-1">
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
            
            <div class="mb-1 row">
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
            
            
            <div class=" mb-1 row">
                <div class="col-md-6">
                <label>Select Pool</label>
                <select name="pool_id" id ="pool_select" class="select" style="width:100%;">
                        @foreach ($pools as $pool)
                            <option @if(old('pool_id'))  selected @endif value="{{$pool->id}}">{{$pool->short_name}}</option>
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
                    <input type="date" name="booking_date"  id="booking_date" class="form-control @error('booking_date') is-invalid @enderror"
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
                    <div class="col-6 col-xs-6 col-md-6">
                        <label>
                            Day <input type="radio" name="slot_id" id="dayslot" class="" value="1">
                        </label>
                    </div>
                    <div class="col-6 col-xs-6 col-md-6">
                        <label>
                            Night <input type="radio" name="slot_id" id="nightlot" class="" value="2">
                        </label>
                    </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-6 col-xs-6 col-md-6">
                            <label>
                                IBAN <input type="radio"  name="payment_mode" id="ibanopt" class="payment_mode" value="iban">
                            </label>
                        </div>
                        <div class="col-6 col-xs-6 col-md-6">
                            <label>
                                Credit Card <input type="radio" name="payment_mode" id="credit_cardopt" class="payment_mode" value="credit_card">
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
@endsection
@section('scripts')
<script type="text/javascript">
function fillIBAN()
{
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
}
$(document).ready(function(){

    fillIBAN();
    //close booking modal
    $("#close_modal").click(function(){
      $("#bookingModal").modal('hide');
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
    function edit(ele)
    {
        
       var id = $(ele).data('id');
       $("#bookingModal").modal('show');
       $.ajax( {
            url: "{{route('ajax.getBookingDetail')}}",
            data:  {
                booking_id:id
            },
            success:function(result){
              
              // result = JSON.parse(result);
               $("#user_select").val(result.id);
               $("#customer_id").val(result.id);
               $("#booking_date").val(result.booking_date);
               $("#pool_select").val(result.pool_id);
               if(result.slot_id==1)
               {
                $("#dayslot").attr("checked",'true');
               }
               else{
                $("#nightslot").attr("checked",'true');
               }
               if(result.payment_mode=='iban')
               {
                $("#ibanopt").attr("checked",'true');
                $("#iban_show").removeClass("d-none");
            $("#card_show").addClass("d-none");
               }
               else{
                $("#credit_cardopt").attr("checked",'true');
                $("#card_show").removeClass("d-none");
            $("#iban_show").addClass("d-none");
               }
               



            }
        });
       
    }
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
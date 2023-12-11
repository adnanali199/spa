@extends('layouts.owner')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6 col-md-12">
                <h4 class="m-0"><i class="fa fa-plus"></i>
                {{ __('Book a Pool') }}
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
                 {{__('New Booking')}}
                </div>
                <div class="row">
             
                
             <div class="col-md-12">
                <div class="card">
                    <div class="card-body p-5">
                        <form method="POST" action="{{ route('owner.bookingaction') }}" enctype="multipart/form-data">
                            @csrf
                            
                            <h3>Customer info</h3>
                            <hr>
                            <input type="hidden" name="customer_id" id="customer_id" value="">
                            <div class="mb-3 cname_section">
                                <label>Customer Name <i class="fa fa-plus" id="new_customer"> </i></label>
                                <select name="customer_name" id="user_select" class="user_select form-control @error('customer_id') is-invalid @enderror">
                                </select>
                                <input type="text" name="name" id="customer_name" class="mt-3 form-control @error('name') is-invalid @enderror"
                                
                                
                                  placeholder="Customer Name" value="" >
                               
                                @error('customer_id')
                                <span class="error invalid-feedback">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                          
                          
                            <div class="mb-3">
                                <label>CPR </label>
                                <input type="number" min=0 step=0.1 name="cpr" id="cpr" class="form-control @error('cpr') is-invalid @enderror"
                                       placeholder="{{ __('CPR') }}"
                                       value="{{    ($booking)?$booking->cpr:old('cpr') }}"
                                       required autocomplete="cpr" autofocus>
                               
                                @error('cpr')
                                <span class="error invalid-feedback">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            
                            <div class="mb-3 row">
                                <div class="col-md-6">
                                <label>Phone Number</label>
                                <input type="number" min=0 step=0.1 name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror"
                                       placeholder="{{ __('phone') }}"
                                       value="{{    ($booking)?$booking->phone:old('phone') }}"
                                       required autocomplete="phone" autofocus>
                               
                                @error('phone')
                                <span class="error invalid-feedback">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label>E-mail</label>
                                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
                                       placeholder="{{ __('email') }}"
                                       value="{{    ($booking)?$booking->email:old('email') }} "
                                       required autocomplete="email" autofocus>
                               
                                @error('email')
                                <span class="error invalid-feedback">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            </div>
                            
                            <h3>Booking info</h3>
                            <hr>
                            <div class=" mb-3 row">
                                <div class="col-md-6">
                                <label>Select Pool</label>
                                <select name="pool_id" class="select" style="width:100%;height:90px">
                                        @foreach ($pools as $pool)
                                            <option @if($pool->id==!empty($booking)?$booking->pool_id:old('pool_id')) selected @endif value="{{$pool->id}}">{{$pool->short_name}}</option>
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
                                    <input type="date" name="booking_date" class="form-control @error('booking_date') is-invalid @enderror"
                                           placeholder="{{ __('booking_date') }}"
                                           value="{{    ($booking)?$booking->booking_date:old('booking_date') }}" 
                                           required autocomplete="booking_date" autofocus>
                                   
                                    @error('booking_date')
                                    <span class="error invalid-feedback">
                                        {{ $message }}
                                    </span>
                                    @enderror
                               
                            </div>
                            </div>
                            <!-- Day/Night -->
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label>
                                            Day <input type="radio" name="slot_id" class="" value="1">
                                        </label>
                                    </div>
                                    <div class="col-md-6">
                                        <label>
                                            Night <input type="radio" name="slot_id" class="" value="2">
                                        </label>
                                    </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label>
                                                IBAN <input type="radio"  name="payment_mode" class="payment_mode" value="iban">
                                            </label>
                                        </div>
                                        <div class="col-md-6">
                                            <label>
                                                Credit Card <input type="radio" name="payment_mode" class="payment_mode" value="credit_card">
                                            </label>
                                        </div>
                                        </div>
                                        <div class="row d-none" id="iban_show">
                                            <div class="col-12">
                                                <div class="form__div">
                                                    <input type="text" name="iban" class="form-control" placeholder="IBAN ">
                                                    <label for="" class="form__label">IBAN</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row d-none" id="iban_show">
                                            <div class="col-12">
                                                <div class="form__div">
                                                    <input type="text" name="iban" class="form-control" placeholder="IBAN ">
                                                    <label for="" class="form__label">IBAN</label>
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
                    <!-- /.card-body -->

                    <div class="card-footer clearfix">
                        
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
    $('.select').select2();
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
    $("#new_customer").click(function(){
        $("#customer_name").show();
        $("#user_select,.cname_section .select2").hide();
    });
    $("#customer_name").hide();
    $(".payment_mode").change(function(){
       
        if($(this).val()=="iban")
        {
            $("#iban_show").removeClass("d-none");
            $("#card_show").addClass("d-none");
        }
        else
        {
            $("#card_show").removeClass("d-none");
            $("#iban_show").addClass("d-none");
        }
    });
    $(".user_select").select2({
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




</script>

@endsection
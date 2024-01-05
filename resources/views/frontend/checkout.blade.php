@extends('frontend.layouts.app')
@section('styles')
<style>
    
    @media screen and (max-width:500px)
    {
        .customer_details.table th, .table td,.customer_details.table th, .table td input
    {
        padding:2px;
    }
        td,th,input.form-control,label,p,div{
            font-size:12px;
        }
    }
</style>
@endsection
@section('content')
<div class="container">

<hr>
<div class="row py-3">
    
    <div class="col-md-12">
        
        <form action="{{route('pool.bookaction')}}" method="POST">
            @csrf
            
            <div class="card">
                <div class="card-header"><h4>{{__('Customer Information')}}</h4></div>
                <div class="card-body">
                    <div class="row">
                        <input type="hidden" name="owner_id" value="{{ \Session::get('owner_id') }}" id="owner_id"> 
                        @guest
                        <input type="hidden" name="user_id" value="0" id="user_id"> 
                        @endguest
                        @auth
                        <input type="hidden" name="user_id" value="{{\Auth::user()->id }}" id="user_id"> 
                       @endauth

                        <div class="table-responsive">
                        <table class="table customer_details">
                        <tr>
                            <th>{{ __('Phone')}}</th><th>{{ __('Name') }}</th><th>{{ __('CPR') }}</th>
                        </tr>
                        @auth
                        <tr><td>{{ $user->phone }}</td>
                        <td >{{ $user->name }}</td>
                        <td >{{$user->cpr }}</td>
                        </tr>
                        @endauth
                        @guest
                        <tr>
                            <td ><input type="text" placeholder="{{__('Phone')}}" required name="phone" class="form-control" id="phone"></td>
                            <td><input type="text"  placeholder="{{__('Name')}}" required name="customer_name" class="form-control" id="customer_name"></td>
                            <td ><input type="text" placeholder="{{__('CPR')}}" required name="cpr" class="form-control" id="cpr"></td>
                            </tr>
                        @endguest
                    </table>
                </div>
                    </div>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header"><h4>{{__('Order Information')}}</h4></div>
                <div class="card-body px-0">
                    <table class="table">
                        <tr>
                            <th>{{__('Pool') }}</th>
                            <th>{{__('Date') }}</th>
                            <th>{{__('Period') }}</th>
                            <th width="44px">{{__('Advance') }}</th>
                            <th></th>
                        </tr>
                        @php  $total=0; @endphp
                        @if($cart)
                        @foreach($cart as $item)
                        <input type="hidden" name="pool_id[]" value="{{$item['pool_id']}}">
                        <input type="hidden" name="booking_date[]" value="{{$item['booking_date']}}">
                        <input type="hidden" name="slot_id[]" value="{{$item['slot_id']}}">
                        
                        @php
                        $total += $item['normal_price'];
                        @endphp
                        <tr>
                            <td> {{ $item['pool_name'] }} </td>
                        <td> {{ $item['booking_date'] }} </td>
                        <td> {{ ($item['slot_id']==1)?'DAY':'NIGHT' }} </td>
                        <td>
                            <input type="number" name="advance_price[]" class="form-control" value="{{$item['advance_price']}}" id="advance_total">
                        </td>
                        <td>
                            <a href="{{route('pool.removeCartItem',$loop->index)}}" title="{{__('Remove from cart')}}" class="btn btn-sm btn-danger"><i class="fas fa-trash" style="font-size:12px"></i></a>
                        </td>
                            
                        @endforeach
                        @else
                        <td colspan="4" class="text-center"> Cart is empty </td>
                        @endif
                       
                    </table>
                    <div class="row">
                        
                        @php
                       
                        @endphp
                        <div class="col-6 mt-3">
                            <input type="hidden" name="total_price" class="form-control" value="{{$total??'0'}}" id="total">
                            <div class="col-md-12 text-center "><h4 style="border:1px solid #eee;width:250px;padding:10px;margin:0px auto;background:#eee" class="text-success">{{ __('Total Payable') }} : {{$total??'0'}} BHD</h4></div>
                            </div>
                            
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header"><h4>{{__('Payment Information')}}</h4></div>
                <div class="card-body">
                    <div class="row">
                      
                        <div class="col-md-6 col-6 text-center">
                            <label>
                                IBAN <input type="radio"  name="payment_mode" class="payment_mode radio" value="iban" checked required>
                            </label>
                        </div>
                        <div class="col-md-6 col-6 text-center">
                            <label>
                                Credit Card <input type="radio" name="payment_mode" class="payment_mode radio" value="credit_card" required>
                            </label>
                        </div>
                    </div>
                        <div class="row  mt-3" id="iban_show">
                            <div class="col-12">
                                <div class="form__div">
                                    <input type="text" readonly name="iban" id="iban_field" value="{{$settings->iban}}" class="form-control" placeholder="IBAN ">
                                    <label for="" class="form__label">IBAN <span class="text-right"> <span id="copy_iban" class="mt-2 btn btn-sm btn-success d-none">Copy IBAN</span></span></label>
                                </div>
                               
                            </div>
                        </div>
                        <div class="row d-none mt-3" id="card_show">
                            <div class="col-12">
                                <div class="form__div">
                                    <input type="text" class="form-control" placeholder=" " name="card_number">
                                    <label for="" class="form__label">Card Number</label>
                                </div>
                            </div>
            
                            <div class="col-6">
                                <div class="form__div">
                                    <input type="text" class="form-control" placeholder=" " name="mm/yy">
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
                                    <input type="text" name="name_on_card" class="form-control" placeholder=" ">
                                    <label for="" class="form__label">name on the card</label>
                                </div>
                            </div>
                            <hr>
                        </div>
                       @if($cart)
                        <div class="col-md-12 text-center bt-1">
                            <button  id="submit_btn" class="btn  btn-info ">Proceed</button> 
                
                        </div>
                        @endif
                   
                </div>
            </div>            
            
            
        </form>
    
     </div> 
    
 <div class="col-sm-12">


</div>

</div>

</div>

@endsection

@section('scripts')
<script>
     function checkCustomerExists(name,cpr,phone,slot)
   {
    customer_id = $("#customer_id").val();
    $.ajax( {
            url: "{{route('check_user')}}",
            data:  {
                customer_name:name,
                cpr:cpr,
                phone:phone,
                mode:slot
            },
            success:function(result){
              if(result.status==1 && !customer_id)
              {
                if(slot=="day"){
                $("#customer_name").val('');$("#cpr").val('');$("#phone").val('');
                }
                else{$("#ncustomer_name").val('');$("#ncpr").val('');$("#nphone").val('');}
                alert('Customer exists already');
              }

            }
        }); 
   }
    $(document).ready(function(){

        $("#customer_name,#cpr,#phone").change(function(){
        customer_name = $("#customer_name").val();
        cpr =  $("#cpr").val();
        phone =   $("#phone").val();
        if($(this).val().trim().length>2){
        checkCustomerExists(customer_name,cpr,phone,'day');
        }
    });
   

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
    });
</script>
@endsection
  
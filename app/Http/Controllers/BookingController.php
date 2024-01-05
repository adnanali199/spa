<?php

namespace App\Http\Controllers;

use App\Models\Pool;
use App\Models\Booking;
use App\Models\BookingDetail;
use App\Models\User;
use App\Models\Customer;
use App\Models\PoolScheduleSlots;
use App\Models\PoolSchedule;
use App\Models\BookingPayment;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Hash;
class BookingController extends Controller
{
    //
    public function index()
    {
        $pools = Pool::all();
        return view('owner.booking.list',compact('pools'));
    }
    public function list(Request $request)
    {
        $data=array();
        $pools = Pool::paginate()->where('owner_id',\Auth::user()->id);

         $owner_pools = array();
         $i=0;
         foreach($pools as $pool)
         {
            $owner_pools[$i]=$pool->id; 
            $i++;
         }
        if ($request->ajax()) {
           
            $data = Booking::join('users','bookings.customer_id','=','users.id')
            ->select('bookings.id','users.name','bookings.status')->orderBy('bookings.id','desc')
            ->join('booking_details','bookings.id','=','booking_details.booking_id')->whereIn('booking_details.pool_id',$owner_pools)->groupBy('bookings.id');

            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn='';
                        
                        if($row->status==2){  
                                $btn .='<a href="javascript:void(0)" onClick="approve(this)"  data-mode="approve"  data-id="'.$row->id.'" class="mt-1 ml-1 edit btn btn-success btn-sm">Approve</a>
                                <a href="javascript:void(0)" onClick="approve(this)"  data-mode="reject"   data-id="'.$row->id.'" class="mt-1 edit btn btn-danger btn-sm">Reject</a>';
                        }
                        else{
                            $btn .='';
                        }
                                return $btn;
                    })
                    ->editColumn('status',function($row){
                       
                          
                        return (($row->status==2)?'Pending':(($row->status==1)?'Approved':'Rejected'));
                    })
                    
                    ->addColumn('pool',function($row){
                        $pool_name ="";
                        foreach($row->pools as $pool)
                        {
                        $pool_name.="<p>".$pool->pool_name ."- <strong>".$pool->pivot->booking_date." ".(($pool->pivot->slot_id==1)?'Day':'Night')."</strong></p>";
                        }
                        return $pool_name;
                    })
                    ->rawColumns(['action','pool'])
                    ->make(true);
        }
    }
    public function newBooking($id=false)
    {
        if($id)
        {
            $booking=Booking::where('id',$id)->first();
            $data['booking']=$booking;
        }
        else{
            $data['booking']=array();
        }
        $data['pools']=Pool::where('owner_id',\Auth::user()->id)->get();

        return view('owner.booking.create',$data);
    }
    public function bookingAction(Request $request)
    {
        
      //dd($request->all());
        if($request->slot_id==1){
        //validate
        $request->validate([
            "pool_id"=>"required",
            "booking_date"=>"required",
            "slot_id"=>"required",
        ]);

        $booking_id = $request->booking_id?$request->booking_id:0;
        $pool_id = $request->pool_id;
        $slot_id = $request->slot_id;
        $booking_date = $request->booking_date;
        $booking_type = $request->booking_type;
        $notes = $request->notes;
        $advance = $request->advance_price;
        $total = $request->total_price;
        $customer_id = $request->customer_id;
        }
        else{
            $request->validate([
                "npool_id"=>"required",
                "nbooking_date"=>"required",
                "nslot_id"=>"required",
            ]);

            $booking_id = $request->nbooking_id?$request->nbooking_id:0;
            $pool_id = $request->npool_id;
            $slot_id = $request->nslot_id;
            $pool_id = $request->npool_id;
            $booking_date = $request->nbooking_date;
            $booking_type = $request->nbooking_type;
            $notes = $request->nnotes;
            $advance = $request->nadvance_price;
            $total = $request->ntotal_price;
            $customer_id = $request->ncustomer_id;
        }
       
        if($customer_id==0 || !$customer_id || $customer_id=="0")
        {
            
            
            $cpr=$request->cpr?$request->cpr:$request->ncpr;
            $phone=$request->phone?$request->phone:$request->nphone;
            $name=$request->customer_name?$request->customer_name:$request->ncustomer_name;
            $password = Hash::make($request->phone?$request->phone:$request->nphone);
            $user_exists=User::where('cpr',$cpr)->orWhere('phone',$phone)->first();
            if(!$user_exists){
            $user=new User();
            $user->cpr=$cpr;
            $user->name=$name;
            $user->phone=$phone;
            $user->password=$password;
            $user->save();
            $customer_id=\DB::getPdo()->lastInsertId(); 
            Customer::create(['user_id'=>$customer_id,'cpr'=>$cpr]);   
        }
        else{
            $customer_id = $user_exists->id;
        }

            
        }
       
        if($booking_id==0)
        {
        $booking = new Booking();
        $booking->status = 1;
        $booking_detail = new BookingDetail();
        $booking_payment = new BookingPayment();
        
        }
        else{
          //print_r($request->all());die();
            $booking= Booking::find($booking_id);
            $booking_detail=BookingDetail::where('booking_id',$booking_id)->where('slot_id',$slot_id)->first();
            $booking_payment=BookingPayment::where('booking_id',$booking_id)->first();
        }
        $booking->customer_id = $customer_id;
        $booking->booking_type = $booking_type;
        $booking->total_price = $total;
        $booking->notes = $notes;
        //$booking->book = $notes;
        $booking->save();
        if($booking_id==0)
        {
            $booking_id=\DB::getPdo()->lastInsertId();
        }
       if(!$booking_payment)
       {
        $booking_payment=new BookingPayment();
       }
       elseif(!$booking_detail)
       {
        $booking_detail = new BookingDetail();
       }
      // dd($booking_id);
        $booking_payment->booking_id =  $booking_id;
        $booking_payment->status = 1;
        $booking_payment->payment_mode=$request->payment_mode;
        $booking_payment->name_on_card=$request->name_on_card?$request->name_on_card:NULL;
        $booking_payment->save();
        //save booking details and schedules
        $booking_detail->booking_id = $booking_id;
        $booking_detail->slot_id = $slot_id;
        $booking_detail->pool_id = $pool_id;
        $booking_detail->booking_date = $booking_date;
        $booking_detail->advance_price = $advance;
        $booking_detail->save();
            

        $data=array('pool_id'=>$pool_id,'date_available'=>$booking_date,'booking_id'=>$booking_id);
        $ps_item = PoolSchedule::firstOrCreate($data);
            
        $pool_schedule_slot = PoolScheduleSlots::firstOrCreate(array('schedule_id'=>$ps_item->id,'slot_id'=>$slot_id,'status'=>'booked'));
        

        return redirect()->back()->with('success','Booking Created Successfully');
        }
    public function sbookingAction(Request $request)
    {
        

        //validate
        $request->validate([
            "pool_id"=>"required",
            "booking_date"=>"required",
           
        ]);

        $user_id = \Auth::user()->id;
        $booking_id = $request->booking_id?$request->booking_id:0;
       
        
        if($booking_id==0)
        {
        $booking = new Booking();
        $booking->status = 1;
        }
        else{
          //print_r($request->all());die();
            $booking= Booking::find($booking_id);
        }
        $booking->pool_id = $request->pool_id;
        $booking->customer_id = $user_id;
        $booking->booking_date = $request->booking_date;
        $booking->slot_id = $request->booking_type;
        
        $booking->save();
        
        $data=array('pool_id'=>$request->pool_id,'date_available'=>$request->booking_date);
        $item = PoolSchedule::firstOrCreate($data);
        if($request->booking_type==3){
            $status="maintenance";
        }
        elseif($request->booking_type==4)
        {
            $status="private";
        }
        else{
            $status="special";
        }
        
        $pool_schedule_slot = PoolScheduleSlots::firstOrCreate(array('schedule_id'=>$item->id,'slot_id'=>$request->booking_type,'status'=>$status));
        return redirect()->back()->with('success','Booking Created Successfully');
    }
}

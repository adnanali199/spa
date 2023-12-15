<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Pool;
use App\Models\Booking;
use App\Models\PoolSchedule;
use App\Models\BookingPayment;
use App\Models\User;
use App\Models\Settings;
use App\Models\PoolScheduleSlots;
use App\Models\PoolFeatures;
class FrontendController extends Controller
{
    public function __construct()
    {
       
    }
    // display the frontend page
    public function index()
    {
        $pools = Pool::all();
        $settings = Settings::find(1);
        return view('frontend.index',compact('pools','settings'));
    }
    public function pool($id=false)
    {

        $pool = Pool::find($id);
        $settings = Settings::find(1);
        $features = PoolFeatures::where('pool_id',$id)->get();
        return view('frontend.pool',compact('pool','settings','features'));
    }
    public function bookPool($id=false)
    {
     $pool = Pool::find($id);
     $date_available =PoolSchedule::join("pool_schedule_slots","pool_schedules.id",'=','pool_schedule_slots.schedule_id')->where('pool_id',$id)->where('pool_schedule_slots.status','available')->where('date_available','>=',date('Y-m-d'))->get();
     //echo "<pre>";print_r($date_available);die();
     $dates=array();
     $i=0;
     foreach($date_available as $da)
     {
        $dates[$i]=$da->date_available;
        $i++;
     }
     $settings = Settings::find(1);
     $features = PoolFeatures::where('pool_id',$id)->get();
    // echo "<pre>";print_r(json_encode($dates));die();
     return view('frontend.book_pool',compact('pool','dates','settings','features'));
    }
     public function bookPoolAction(Request $request)
     {
        
         //validate
         $request->validate([
             "pool_id"=>"required",
             "booking_date"=>"required",
             "slot_id"=>"required",
         ]);
 
         $user_id = $request->user_id?$request->user_id:0;
 
         
         $booking = new Booking();
         $booking->pool_id = $request->pool_id;
         $booking->customer_id = $user_id;
         $booking->booking_date = $request->booking_date;
         $booking->slot_id = $request->slot_id;
         $booking->status = 2;
         $booking->save();
         $booking_payment = new BookingPayment();
         $booking_payment->booking_id =  \DB::getPdo()->lastInsertId();
         $booking_payment->status = 2;
         $booking_payment->payment_mode=$request->payment_mode;
         $booking_payment->name_on_card=$request->name_on_card?$request->name_on_card:NULL;
         $booking_payment->save();
         
         $pool_schedule_slot = PoolScheduleSlots::where('schedule_id',$request->schedule_id)->where('slot_id',$request->slot_id)->update(['status'=>'booked']);
         return redirect(route('bookings'))->with('success',"Your booking request is sent successfully.");
     }
     public function search(Request $request)
     {
        $search = $request->search_term;
        $date_from = $request->date_from;
        $date_to = $request->date_to;
        $city = $request->city;
        $pools = Pool::where('pool_name','LIKE',"%{$search}%")->orWhere('short_name','LIKE',"%{$search}%")
        ->orWhere('features','LIKE',"%{$search}%")
        ->orWhere('rules','LIKE',"%{$search}%");
        if($date_from && $date_to)
        {
            $pools->join("pool_schedules","pools.id","=","pool_schedules.pool_id")
            ->whereBetween('date_available', [$date_from, $date_to]);
        }
        if($city)
        {
           
            $pools->where('pools.city','LIKE',"%{$city}%");
        }
     
       // $pools->groupBy('pools.id');
        $pools=$pools->select('pools.*')->distinct()->get();
        return view('frontend.index',compact('pools','search','date_from','date_to','city'));
     }
    public function saveToken(Request $request){
        $user = auth()->user();
        $user->device_token=$request->token;
        $user->save();
        return response()->json(['token saved successfully.']);
    }
    public function myBookings(Request $request)
    {
       
        $bookings = Booking::join('users','bookings.customer_id','=','users.id')
        
        ->join('pool_slots','pool_slots.id','=','bookings.slot_id')
        ->where('bookings.customer_id',"=",\Auth::user()->id)
        ->orderBy('bookings.id','desc')
        ->get(['bookings.*', 'pool_slots.slot']);
        
       
     
        return view('frontend.bookings',compact('bookings'));
    }
    }

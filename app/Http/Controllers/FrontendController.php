<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Pool;
use App\Models\Booking;
use App\Models\PoolSchedule;
use App\Models\BookingPayment;
use App\Models\User;
use App\Models\Settings;
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
        return view('frontend.pool',compact('pool','settings'));
    }
    public function bookPool($id=false)
    {
     $pool = Pool::find($id);
     $date_available =PoolSchedule::where('pool_id',$id)->get();
     //echo "<pre>";print_r($date_available);die();
     $dates=array();
     $i=0;
     foreach($date_available as $da)
     {
        $dates[$i]=$da->date_available;
        $i++;
     }
     $settings = Settings::find(1);
    // echo "<pre>";print_r(json_encode($dates));die();
     return view('frontend.book_pool',compact('pool','dates','settings'));
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
         
         return redirect(route('/'))->with('success',"Your booking request is sent successfully.");
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
   
    }

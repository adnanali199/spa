<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Pool;
use App\Models\Booking;
use App\Models\PoolSchedule;
use App\Models\BookingPayment;
use App\Models\BookingDetail;
use App\Models\User;
use App\Models\Customer;
use App\Models\Settings;
use App\Models\PoolScheduleSlots;
use App\Models\PoolFeatures;
use DB;use Session;
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
        $features = PoolFeatures::join('features','pool_features.feature_id','=','features.id')->where('pool_features.pool_id',$id)->groupBy('pool_features.feature_id','pool_features.pool_id')->get();
        return view('frontend.pool',compact('pool','settings','features'));
    }
    public function bookPool($id=false)
    {

     $pool = Pool::find($id);
     $date_unavailable =
     DB::table("pool_schedules")
     ->join("pool_schedule_slots","pool_schedules.id",'=','pool_schedule_slots.schedule_id')
     ->where('pool_schedules.pool_id',$pool->id)
    ->select('date_available',DB::raw("COUNT(date_available) as total"),'slot_id')
    ->groupBy('date_available')
    ->get();
    // PoolSchedule::join("pool_schedule_slots","pool_schedules.id",'=','pool_schedule_slots.schedule_id')->where('pool_id',$id)->where('date_available','>=',date('Y-m-d'))->groupBy('date_available','pool_id')->get(['date_available','count("date_available")']);
     //echo "<pre>";print_r($date_unavailable);die();
     $dates=array();
     $nightsbooked = array();
     $daysbooked = array();
     $dates1=array();
     $i=0;$j=0;$k=0;
     foreach($date_unavailable as $da)
     {
        //print_r($da->date_available);die();
        if($da->total==2){
        $dates[$i]=date("Y-m-d",strtotime($da->date_available));
        $i++;
        }
        elseif($da->slot_id>2)
        {
            $dates[$i]=date("Y-m-d",strtotime($da->date_available));
            $i++;  
        }
        elseif($da->slot_id==1)
        {
            $daysbooked[$j]=date("Y-m-d",strtotime($da->date_available));
            $j++;
        }
        elseif($da->slot_id==2)
        {
            $nightsbooked[$k]=date("Y-m-d",strtotime($da->date_available));
            $k++;
        }
        
        
     }
     $dates = (array_unique($dates));
     $settings = Settings::find(1);
     $features = PoolFeatures::join('features','pool_features.feature_id','=','features.id')->where('pool_features.pool_id',$id)->get();
     return view('frontend.book_pool',compact('pool','dates','settings','features','nightsbooked','daysbooked'));
    }

    public function checkout(Request $request)
    {
        $user    =      \Auth::user();
        $cart    =      $request->session()->get('cart');
        //echo "<pre>";print_r($cart);die();
        $settings = Settings::find(1);
        return view('frontend.checkout',compact('user','cart','settings'));
       
    }
    public function clearCart(Request $request)
    {
        $request->session()->forget('cart');
        return back()->with('success',"Cart Cleared");
    }
    public function removeCartItem(Request $request,$id)
    {
        $cart = $request->session()->get('cart');
        unset($cart[$id]);
        Session::put('cart', $cart);
         return back()->with('success',"Item Removed from cart.");
    }
    public function addToCart(Request $request)
     {
        $cart = $request->session()->get('cart');
        $submit = $request->submit;
        if($submit && ($cart && count($cart) > 0))
         {
            return redirect(route('pool.checkout'));
         }
         //validate
         $request->validate([
             "pool_id"=>"required",
             "booking_date"=>"required",
                     ]);
         
         $user_id = $request->user_id?$request->user_id:0;
         $pool = Pool::find($request->pool_id);
        
         
         $slot_day = $request->slot_day?$request->slot_day:0;
         $slot_night = $request->slot_night?$request->slot_night:0;
         if($slot_day){
         $data[] =array(
            "pool_id"=>$request->pool_id,
            "pool_name"=>$pool->pool_name ,
            "normal_price"=>$pool->price ,
            "advance_price"=>$pool->advance_price,
            'holiday_price'=>$pool->holiday_price,
            "booking_date"=>$request->booking_date,
            "slot_id"=>1,
            "owner_id"=>$request->owner_id
        );
    }
    if($slot_night){
        $data[] =array(
           "pool_id"=>$request->pool_id,
           "pool_name"=>$pool->pool_name ,
           "normal_price"=>$pool->price ,
           "advance_price"=>$pool->advance_price,
           'holiday_price'=>$pool->holiday_price,
           "booking_date"=>$request->booking_date,
           "slot_id"=>2,
           "owner_id"=>$request->owner_id
       );
   }
        //echo "<pre>";print_r($data);die(); 
        for($i=0;$i<count($data);$i++)
        {
            if($cart && in_array($data[$i],$cart))
            {
            //return back()->with('success',"Already Added to cart.");
            }
            else{
            $cart[] = $data[$i];
            }

        }   
         Session::put('cart', $cart);
         if($submit && count($cart) > 0)
         {
            return redirect(route('pool.checkout'));
         } 
         return back()->with('success',"Added to cart  successfully.");
     }
     public function bookPoolAction(Request $request)
     {
        //echo "<pre>";print_r($request->all());die();
         //validate
         $request->validate([
            
             "payment_mode"=>"required",
            
         ]);
         // user id from logged in user
         $user_id = $request->user_id?$request->user_id:0;
         if($user_id==0 || !$user_id || $user_id=="0")
        {
            
            
            $cpr=$request->cpr;
            $phone=$request->phone;
            $name=$request->customer_name;
            $password = \Hash::make($request->phone);
            $user_exists=User::where('cpr',$cpr)->orWhere('phone',$phone)->first();
            
            if(!$user_exists){
            $user=new User();
            $user->cpr=$cpr;
            $user->name=$name;
            $user->phone=$phone;
            $user->password=$password;
            $user->save();
            $user_id=\DB::getPdo()->lastInsertId(); 
           
            Customer::create(['user_id'=>$user_id,'cpr'=>$cpr]);   
        }
        else{
            $user_id = $user_exists->id;
        }
    }
    //echo "<pre>";print_r($user_id);die();
         // new booking
         $booking = new Booking();
         $booking->booking_type = 'rented';
         $booking->customer_id = $user_id;
         $booking->booking_date = date('Y-m-d');
         $booking->status = 2;
         $booking->total_price = $request->post('total_price');
         $booking->save();
         // get the inserted booking id
         $booking_id = \DB::getPdo()->lastInsertId();
         $advance_price = $request->post('advance_price');
         // get cart items
         $items = $request->session()->get('cart');
         // save booking details 
         $i=0;
         foreach($items as $item){
         $booking_detail = new BookingDetail();
         $booking_detail->booking_id = $booking_id;
         $booking_detail->slot_id = $item['slot_id'];
         $booking_detail->pool_id = $item['pool_id'];
         $booking_detail->booking_date = $item['booking_date'];
         $booking_detail->advance_price = $advance_price[$i];
         $booking_detail->save();
         $i++;
         
         $data=array('pool_id'=>$item['pool_id'],'date_available'=>$item['booking_date'],'booking_id'=>$booking_id);
         $ps_item = PoolSchedule::firstOrCreate($data);
         $pool_id = $item['pool_id'];   
         $pool_schedule_slot = PoolScheduleSlots::firstOrCreate(array('schedule_id'=>$ps_item->id,'slot_id'=>$item['slot_id'],'status'=>'booked'));
         

         }
        // Booking Payment
         $booking_payment = new BookingPayment();
         $booking_payment->booking_id =$booking_id;  
         $booking_payment->status = 2;
         $booking_payment->payment_mode=$request->payment_mode;
         $booking_payment->name_on_card=$request->name_on_card?$request->name_on_card:NULL;
         $booking_payment->save();
         


        // Notification
         $title = "New Booking Request";
         $user = \Auth::check()?\Auth::user()->name:$request->customer_name;
         $pool = Pool::where('id',$pool_id)->first();
         $body  = $user." Sent a booking request for one of your pools , Please check your owner account to approve";
         
         $this->sendNotification($title,$body,$pool->owner_id);
         //after successful booking clear the cart
         $request->session()->forget('cart');
         return redirect(route('bookings'))->with('success',"Your booking request is sent successfully.");
     }
     public function search(Request $request)
     {
        $search = $request->search_term;
        $date_from = $request->date_from;
        $date_to = $request->date_to;
        $city = $request->city;
        $pools = Pool::where('pool_name','LIKE',"%{$search}%")->orWhere('short_name','LIKE',"%{$search}%")
        ->orWhere('city','LIKE',"%{$search}%")
        ->orWhere('state','LIKE',"%{$search}%");
        if($date_from && $date_to)
        {
            $pools->join("pool_schedules","pools.id","=","pool_schedules.pool_id")
            ->whereNotBetween('date_available', [$date_from, $date_to]);
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
       if(\Auth::check()){
        $user = auth()->user();
        //echo $user->device_token;die();
       
        $user->device_token=$request->token;
        $user->save();
        return response()->json(['token saved successfully.']);
        
    }
    return response()->json(['1']);
    }
    public function sendNotification($title="",$body="",$id)
    {
        $firebaseToken = User::where('id',$id)->whereNotNull('device_token')->pluck('device_token')->all();
          
        $SERVER_API_KEY = 'AAAAG30tHsU:APA91bEvvwMGStcJkiYI4u5uOGlkJSh4cuTNKW6Kp3rTmU1Fs3BVefIJiwaO3oQT9bGc5Ic_WhCxYYTTx65MoBexDB-r-JxN-mxm9lCGNqlqPGU12osXQdXOImLOPMoqWqAkBvnLxeLS';
  
        $data = [
            "registration_ids" => $firebaseToken,
            "notification" => [
                "title" => $title,
                "body" => $body,  
            ]
        ];
        $dataString = json_encode($data);
    
        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];
    
        $ch = curl_init();
      
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
               
        $response = curl_exec($ch);
  
        
    }
    public function myBookings(Request $request)
    {
        $bookings=array();
       if(\Auth::check()){
        $bookings = Booking::join('users','bookings.customer_id','=','users.id')
        ->where('bookings.customer_id',"=",\Auth::user()->id)
        ->groupBy('bookings.id')
        ->orderBy('bookings.id','desc')
        ->get(['bookings.*']);
       }
       //dd($bookings);
     
        return view('frontend.bookings',compact('bookings'));
    }
    }

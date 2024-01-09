<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Owner;
use App\Models\Booking;
use App\Models\Pool;
use App\Models\PoolSchedule;
class AjaxController extends Controller
{
    //
    public function getUsers(Request $request)
    {
        $search=$request->search;
        
        $users = User::join('customers','users.id','=','customers.user_id')
        ->where('users.phone','LIKE',"%{$search}%")
        ->orWhere('customers.contact_no','LIKE',"%{$search}%") 
        ->orWhere('users.name','LIKE',"%{$search}%")
        ->orWhere('users.cpr','LIKE',"%{$search}%")
        ->where('user_type',"2")->select('users.name','users.id','users.phone','customers.contact_no','users.email','customers.cpr')->get();
        $response=array();
        $i=0;
        foreach($users as $user)
        {
            
            $response[$i]['id']=$user->id;
            $response[$i]['text']=$user->name;
            $i++;
        }
        return response()->json($response);

    }
    public function getUserDetail(Request $request)
    {
        $user_id =$request->user_id;
        $users = User::where('users.id',$user_id)->join('customers','users.id','=','customers.user_id')->select('users.id','users.name','users.phone','customers.cpr','customers.contact_no')->get();
       
        $response=array();
        foreach($users as $user)
        {
            $response['id']=$user->id;
            $response['name']=$user->name;
            $response['phone']=$user->phone;
            $response['cpr']=$user->cpr;
            
        }
        return response()->json($response);
    }
    public function getPoolBookings(Request $request)
    {
        $newpool = new Pool();
        $owner_pools =$newpool->ownerPool();
        
        $pool_ids =array($request->pool_ids);
         $booking=new Booking();
        $events = $booking->getOwnerBooking($pool_ids);
      
        $formattedEvents = array();
        $i=0;
        foreach($events as $event){
            
            $slots_taken = array();
           
            foreach ($event->pools as $pool )
            {
               
                if(in_array($pool->id,$pool_ids)){
                 $formattedEvents[$i]=array(
                'title' => '',
                'customer_name'=>$event->name,
                'booking_id'=>$event->id,
                'booked_by'=>$event->booked_by,
                'booking_date'=>$pool->pivot->booking_date,
                'pool_name'=>   $pool->pool_name,
                'slot'=>        $pool->pivot->slot_id==1?'Day':'Night',
                'slots'=>$newpool->getSchedules($pool->id,$pool->pivot->booking_date),
                'start' => $pool->pivot->booking_date,
                'end' => $pool->pivot->booking_date,
                'backgroundColor'=>"#333");
                $i++;
                 }
        } 
    }
      
    


        //$formattedEvents['days1']=$newpool->getSchedules($pool_ids[0]);
        return response()->json($formattedEvents);
    }

    // get booking details

    public function getBookingDetail(Request $request,$booking_id)
    {
        
        $bookings = Booking::where('bookings.id',$booking_id)
                ->join('users','users.id','=','bookings.customer_id')
                ->join('pool_slots','bookings.slot_id','=','pool_slots.id')
                ->leftjoin('booking_payment','bookings.id','=','booking_payment.booking_id')
                ->where('bookings.id',$booking_id)
                ->get(['bookings.*','users.name','users.id as customer_id','pool_slots.slot','booking_payment.payment_mode','booking_payment.card_type','booking_payment.name_on_card','booking_payment.status']);
      //echo "<pre>";  print_r($bookings);die();
        $response=array();
        foreach($bookings as $booking)
        {
            $response['id']=$booking->id;
            $response['pool_id']=$booking->pool_id;
            $response['customer_id']=$booking->customer_id;
            $response['customer_name']=$booking->name;
            $response['booking_date']=$booking->booking_date;
            $response['slot_id']=$booking->slot_id;
            $response['payment_mode']=$booking->payment_mode;
            $response['card_type']=$booking->card_type;
            $response['name_on_card']=$booking->name_on_card;
            
        }
        return response()->json($response);
    }

    public function getOwnerIBAN(Request $request)
    {
        $owner_id = $request->owner_id;
        $owner_data = Owner::where('user_id',$owner_id)->get();
        $response=array();
        foreach($owner_data as $owner)
        {
            $response['iban']=$owner->iban;
        }
        return response()->json($response);
    }
    public function changeBookingStatus(Request $request)
    {
        $booking_id = $request->booking_id;
        $mode = $request->mode;
        $booking = Booking::find($booking_id);
        $pool = Pool::find($booking->pool_id);
        $user_id = $booking->customer_id;
        if($mode=="approve")
        {
        $booking->status=1;
        $body="Congratulations! Your booking Request # ". $booking_id ."  approved. Booking Date:".$booking->booking_date;
        }
        else{
            $booking->status=0;
            $body="Sorry! Your booking Request # ". $booking_id ."   rejected. Booking Date:".$booking->booking_date;
        }
        $title="Booking Request Status Changed.";
        $booking->save();
        $response=array("response"=>"1");
        $n_status=$this->sendNotification($title,$body,$user_id);
        $response['n_status']=$n_status;
        return response()->json($response);
    }
    public function changeUserStatus(Request $request)
    {
        $user_id = $request->user_id;
        $mode = $request->mode;
        $user = User::find($user_id);
        if($mode=="approve")
        {
        $user->status=1;
        $body="Congratulations! Your User Request approved.";
        }
        else{
            $user->status=0;
            $body="Sorry! Your user Request rejected.";
        }
        $title="User  Status Changed.";
        $user->save();
        $response=array("response"=>"1");
        $n_status=$this->sendNotification($title,$body,$user_id);
        $response['n_status']=$n_status['success'];
        return response()->json($response);
    }
    public function saveSchedule(Request $request)
    {
        $pool_id = $request->pool_id;
        $mode = $request->mode;
        $booking = Booking::find($booking_id);
      
        
        $booking->save();
        
        
        return response()->json($response);
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
        return $response;
        
    }

    public function getSlots(Request $request)
    {
        $pool_id =$request->pool_id;
        $date = $request->date;
        $bookings =\DB::table('bookings')->join('booking_details','booking_details.booking_id','=','bookings.id')
        ->join('users','users.id','=','bookings.customer_id')
        ->where('booking_details.pool_id',$pool_id)->where('booking_details.booking_date',$date)->get(['bookings.*','booking_details.*','users.*','bookings.id as booking_id']);
        $booking_data = array();$i=0;
        foreach($bookings as $booking)
        {
            $booking_data[$i] = array(
            'booking_id'=>$booking->booking_id,
            'booking_date'=>$booking->booking_date,
            'customer_id'=>$booking->customer_id,
           // 'customer_name'=>$booking->name,
            'cpr'=>$booking->cpr,
            'phone'=>$booking->phone,
            'customer_name'=>$booking->name,
            'slot_id'=>$booking->slot_id,
            'booking_type'=>$booking->booking_type,
            'advance_price'=>$booking->advance_price,'total_price'=>$booking->total_price, 'notes'=>$booking->notes);
           
            $i++;
        }
        $pool= new Pool();
        $events['slots']=$pool->getSchedules($pool_id,$date);
        $events['bookings']=$booking_data;
        return response()->json($events);

    }
    public function checkUser(Request $request)
    {
        //echo "<pre>";print_r($request->all());die();
        $cpr=$request->cpr?$request->cpr:0;
        $phone=$request->phone?$request->phone:0;
        $name=$request->customer_name?$request->customer_name:0;
        $mode = $request->mode;
        $auth = $request->owner?$request->owner:false;
        $user=array();
       if(!empty($phone)){
        $user=User::where('phone',$phone)->get();
        //echo "<pre>";print_r($phone_exists);die();
       }
       if(!empty($name)){
       
       $user=User::where('name','=',$name)->get();//->orWhere('cpr',$cpr)->orWhere('name','=',$name)->get();
       }
       if(!empty($cpr)){ 
       $user=User::where(['cpr'=>$cpr])->get();
       }
            if(count($user)>0){
             if(!$auth){
               if(\Auth::attempt(array('phone'=>$user[0]->phone,'password'=>$user[0]->cpr)))
               {
                $auth = 1;
               }
            }
            else{
            
            }
                return response()->json(array('status'=>1,'slot'=>$mode,'user'=>$user,'auth'=>$auth));
            }
            else{
                return response()->json(array('status'=>0));
            }
    }
}

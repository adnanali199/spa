<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Owner;
use App\Models\Booking;
use App\Models\PoolSchedule;
class AjaxController extends Controller
{
    //
    public function getUsers(Request $request)
    {
        $search=$request->search;
        
        $users = User::where('name','LIKE',"%{$search}%")->join('customers','users.id','=','customers.user_id')
        ->orWhere('customers.contact_no','LIKE',"%{$search}%") ->orWhere('users.name','LIKE',"%{$search}%")
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
            $response['email']=$user->email;
            
        }
        return response()->json($response);
    }
    public function getPoolBookings(Request $request)
    {
        $pool_ids =array($request->pool_ids);
        $events =  Booking::join('users','bookings.customer_id','=','users.id')
        ->join('pools','bookings.pool_id','=','pools.id')
        ->join('pool_slots','pool_slots.id','=','bookings.slot_id')
        ->where('pools.owner_id',\Auth::user()->id)->whereIn('pool_id', $pool_ids)
        ->select('bookings.id','users.name','pools.id as pool_id','pools.pool_name','bookings.booking_date','pool_slots.slot','bookings.status')->orderBy('bookings.id')->get();
       
      
        $formattedEvents = array();
        $i=0;
        foreach($events as $event){
            
            $slots_taken = array();
           
          
            $pool_booking = Booking::where('pool_id',$event->pool_id)->where('booking_date',$event->booking_date) ->join('pool_slots','pool_slots.id','=','bookings.slot_id')->select('booking_date','slot')->groupBy('booking_date')->groupBy('slot')->get();
            $j=0;
            foreach($pool_booking as $pb)
            {
                    $slots_taken[$j]=$pb->slot;
                    $j++;
            }
           
           
            $formattedEvents[$i]=array(
            'title' => $event->name." - ".$event->pool_name,
            'customer_name'=>$event->name,
            'pool_name'=>$event->pool_name,
            'slot'=>$event->slot,
            'start' => $event->booking_date,
            'end' => $event->booking_date,
            'backgroundColor'=>"#333",
            'slots'=>$slots_taken);
            $i++;
        } 
        
        return response()->json($formattedEvents);
    }

    // get booking details

    public function getBookingDetail(Request $request)
    {
        $booking_id =$request->booking_id;
        $bookings = Booking::where('bookings.id',$booking_id)
                ->join('users','users.id','=','bookings.customer_id')
                ->join('pool_slots','bookings.slot_id','=','pool_slots.id')
                ->join('booking_payment','bookings.id','=','booking_payment.booking_id')
                ->where('bookings.id',$booking_id)
                ->get(['bookings.*','users.name','users.id as customer_id','pool_slots.slot','booking_payment.payment_mode','booking_payment.card_type','booking_payment.name_on_card','booking_payment.status']);
       
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
        if($mode=="approve")
        {
        $booking->status=1;
        $body="Congratulations! Your booking Request approved.";
        }
        else{
            $booking->status=0;
            $body="Sorry! Your booking Request rejected.";
        }
        $title="Booking Request Status Changed.";
        $booking->save();
        $response=array("response"=>"1");
        $this->sendNotification($title,$body);
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
        $this->sendNotification($title,$body);
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
    public function sendNotification($title="",$body="")
    {
        $firebaseToken = User::whereNotNull('device_token')->pluck('device_token')->all();
          
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

    public function getSlots(Request $request)
    {
        $pool_id =$request->pool_id;
        $date = $request->date;
        $events=PoolSchedule::join('pool_schedule_slots','pool_schedules.id','=','pool_schedule_slots.schedule_id')
        ->where('pool_id',$pool_id)->where('date_available',$date)->where('pool_schedule_slots.status','available')->get();
        return response()->json($events);

    }
}

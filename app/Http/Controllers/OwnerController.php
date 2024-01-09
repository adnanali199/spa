<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Customer;
use App\Models\Owner;
use App\Models\Booking;
use App\Models\Pool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Query\Builder;
class OwnerController extends Controller
{
    public function __construct()
    {
       
       // $this->middleware('owner');
    }
    //
    public function index()
    {
        $pools = Pool::paginate()->where('owner_id',Auth::user()->id);

         $owner_pools = array();
         $i=0;
         foreach($pools as $pool)
         {
            $owner_pools[$i]=$pool->id; 
            $i++;
         }
         //dd($owner_pools);
        $booking= new Booking();
        $events =  $booking->getOwnerBooking();
        $formattedEvents = array();
        $i=0;
        foreach($events as $event){
            foreach ($event->pools as $pool )
        {
            if(in_array($pool->id,$owner_pools)){
             $formattedEvents[$i]=array(
            'title' => $event->name." - ".$pool->pool_name,
            'customer_name'=>$event->name,
            'booking_id'=>$event->id,
            'booking_date'=>date('Y-m-d',strtotime($pool->pivot->booking_date)),
            'pool_name'=>   $pool->pool_name,
            'booked_by'=>$event->booked_by,
            'slot'=>        $pool->pivot->slot_id==1?'Day':'Night',
            'start' => $pool->pivot->booking_date,
            'end' => $pool->pivot->booking_date,
            'backgroundColor'=>"#333");
            $i++;
        }
    }
        } 
      

        return view('owner.home', compact('formattedEvents','pools'));
    }
    public function home()
    {
        return view('owner.home');
    }
    public function login()
    {
        return view('owner.auth.login');
    }
    public function register()
    {
        return view('owner.auth.register');
    }
    public function loginAction(Request $request)
    {
        //validate
        $request->validate([
            
            "phone"=>"required",
            "password"=>"required"
        ]);
        //login user here
        if(Auth::attempt(array('phone'=>$request->phone,'password'=>$request->password,'status'=>1)))
        {
            return redirect(route('owner.index'));
        }
         return redirect()->back()->with('error',"Ivalid login, Please contact admin for further informations");
    }
    public function registerAction(Request $request)
    {
        
        //validate
        $request->validate([
            "name"=>"required|min:5",
            "phone"=>"required",
            "email"=>"",
            "password"=>"required|confirmed|min:8"
        ]);
        //save owner data in users table
       $user= \DB::table('users')->insert([
            "name"          =>  $request->name,
            "email"         =>  $request->email,
            "phone"         =>  $request->phone,
            "password"      =>  Hash::make($request->password),
            "address"       =>  $request->password,
            "user_type"     =>  3

        ]);
        $user_id =  $user_id=\DB::getPdo()->lastInsertId();
       // die($user_id);
        $cpr = $request->cpr;
        $iban = $request->iban;
        $contract_no = $request->contract_no;
        Owner::create([
            'user_id'=>$user_id,
            'cpr'=>$cpr,
            'iban'=>$iban,
            'contract_no'=>$contract_no
        ]);
        //login user here
        /*if(Auth::attempt($request->only('email','password')))
        {
            return redirect(route('owner.index'));
        }*/
        return redirect(route('owner.login'))->with('error',"Your Account Created successfully and waiting for admin approval..");
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
}

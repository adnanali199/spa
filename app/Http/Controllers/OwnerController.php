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
        $events =  Booking::join('users','bookings.customer_id','=','users.id')
        ->join('pools','bookings.pool_id','=','pools.id')
        ->join('pool_slots','pool_slots.id','=','bookings.slot_id')
        ->where('pools.owner_id',\Auth::user()->id)
        ->select('bookings.id','users.name','pools.pool_name','pools.id as pool_id','bookings.booking_date','pool_slots.slot','bookings.status')->orderBy('bookings.id')->get();
        $pools = Pool::paginate()->where('owner_id',Auth::user()->id);

        $formattedEvents = array();
        $i=0;
        foreach($events as $event){
            $slots_taken = array();
           
          
            $pool_booking = Booking::where('pool_id',$event->pool_id) ->join('pool_slots','pool_slots.id','=','bookings.slot_id')->select('booking_date','slot')->groupBy('booking_date')->groupBy('slot')->get();
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
          //  'slots'=>$slots_taken,
            'start' => $event->booking_date,
            'end' => $event->booking_date,
            'backgroundColor'=>"#333");
            $i++;
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

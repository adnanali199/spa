<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Customer;
use App\Models\Owner;
use App\Models\Admin;
use App\Models\Booking;
use App\Models\Pool;
use App\Models\Settings;
use App\Models\Features;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Query\Builder;
class AdminController extends Controller
{
    public function __construct()
    {
       
       // $this->middleware('admin');
    }
    //
    public function index()
    {
       // $events =  Booking::join('users','bookings.customer_id','=','users.id')
        $events = Booking::join('users','bookings.customer_id','=','users.id')
            ->select('bookings.id','users.name','bookings.status')->orderBy('bookings.id','desc')->get();
            
        
        
        $pools = Pool::paginate();
        $total_users = User::where('user_type','2')->count();
        $total_owners = User::where('user_type','3')->count();
        $total_users_pa = User::where('user_type',3)->where('status','0')->count();
        $total_bookings = Booking::count();
        $total_pools = Pool::count();
        $formattedEvents = array();
        $i=0;
       
          
            foreach($events as $event){
                foreach ($event->pools as $pool )
            {
                
                 $formattedEvents[$i]=array(
                'title' => $event->name." - ".$pool->pool_name,
                'customer_name'=>$event->name,
                'booking_id'=>$event->id,
                'booking_date'=>date('Y-m-d',strtotime($pool->pivot->booking_date)),
                'pool_name'=>   $pool->pool_name,
                'slot'=>        $pool->pivot->slot_id==1?'Day':'Night',
                'start' => $pool->pivot->booking_date,
                'end' => $pool->pivot->booking_date,
                'backgroundColor'=>"#333");
                $i++;
            
        }
            } 
      
        return view('admin.home', compact('formattedEvents','pools','total_users','total_bookings','total_users_pa','total_owners','total_pools'));
    }
    public function home()
    {
        return view('admin.home');
    }
    public function login()
    {
       
        return view('admin.auth.login');
    }
    public function register()
    {
        return view('admin.auth.register');
    }
    public function loginAction(Request $request)
    {
        //validate
        $request->validate([
            
            "phone"=>"required",
            "password"=>"required"
        ]);
        //login user here
        if(Auth::attempt($request->only('phone','password')))
        {
            return redirect(route('admin.index'));
        }
         return redirect()->back()->with('error',"Ivalid login");
    }
    public function registerAction(Request $request)
    {
        
        //validate
        $request->validate([
            "name"=>"required|min:5",
            "phone"=>"required",
            "email"=>"required|email|unique:users",
            "password"=>"required|confirmed|min:8"
        ]);
        //save Admin data in users table
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
        Admin::create([
            'user_id'=>$user_id,
            'cpr'=>$cpr,
            'iban'=>$iban,
            'contract_no'=>$contract_no
        ]);
        //login user here
        if(Auth::attempt($request->only('email','password')))
        {
            return redirect(route('admin.index'));
        }
        return back()->with('error',"something went wrong, Please try again..");
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
    // Owners section 
    public function owners()
    {
        return view('admin.booking.list');
    }
    // owners section datatables
    public function ownerList(Request $request)
    {
       
        $data=array();
        if ($request->ajax()) {
           
            $data = User::join('user_types','users.user_type','=','user_types.id')
            ->join('owners','owners.user_id','=','users.id')
            //->where('pools.owner_id',"=",\Auth::user()->id)
            ->select('users.id','users.name','users.email','users.phone','owners.cpr','owners.iban','owners.contract_no','users.status')->orderBy('users.id','desc');

            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        if($row->status==0){    
                        $btn = '<a href="javascript:void(0)" onClick="approve(this)"  data-mode="approve"  data-id="'.$row->id.'" class="edit btn btn-success btn-sm">Approve</a>
                                <a href="javascript:void(0)" onClick="approve(this)"  data-mode="reject"   data-id="'.$row->id.'" class="edit btn btn-danger btn-sm">Reject</a>';
                        }
                        else{
                            $btn='';
                        }
                                return $btn;
                    })
                    ->editColumn('status',function($row){
                       
                          
                        return (($row->status==0)?'Pending':(($row->status==1)?'Approved':'Rejected'));
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
    }
    public function users()
    {
        return view('admin.users.list');
    }
    public function UserList(Request $request)
    {
       
        $data=array();
        if ($request->ajax()) {
           
            $data = User::join('user_types','users.user_type','=','user_types.id')
            ->join('customers','customers.user_id','=','users.id')
            //->where('pools.owner_id',"=",\Auth::user()->id)
            ->select('users.id','users.name','users.email','users.phone','customers.cpr','users.status')->orderBy('users.id','desc');

            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        if($row->status==0){    
                        $btn = '<a href="javascript:void(0)" onClick="approve(this)"  data-mode="approve"  data-id="'.$row->id.'" class="edit btn btn-success btn-sm">Approve</a>
                                <a href="javascript:void(0)" onClick="approve(this)"  data-mode="reject"   data-id="'.$row->id.'" class="edit btn btn-danger btn-sm">Reject</a>';
                        }
                        else{
                            $btn='';
                        }
                                return '';
                    })
                    ->editColumn('status',function($row){
                       
                          
                        return 'Approved';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
    }
    public function settings($id=false)
    {
       
        $data['settings']=Settings::find(1);

        return view('admin.settings.create',$data);
    }
    public function settingsAction(Request $request)
    {

        //validate
        $request->validate([
            "name"=>"required",
            "contact_no"=>"required",
            "address"=>"required",
        ]);

    
        
        $settings = settings::find(1);
        $settings->name = $request->name;
        $settings->address = $request->address;
        $settings->iban = $request->iban;
        $settings->email = $request->email;
        $settings->contact_no = $request->contact_no;
        $settings->facebook = $request->facebook;
        $settings->twitter = $request->twitter;
        $settings->paypal_key = $request->paypal_key;
        $settings->stripe_key = $request->stripe_key;
       
        if($request->hasFile('logo'))
        {
            
            $logo = $request->file('logo');
            $filename = time().'_'.$logo->getClientOriginalName();
            $filePath = $logo->storeAs('uploads', $filename, 'public');
            $logo->move("uploads",$filePath);
            $settings->logo = $filename;
            //$pool->save();
        }
        $settings->save();
        
        return back()->with('success',"Settings added Successfully..");
    }
    public function features($id=false)
    {
       
        $data['features']=Features::all();
        if($id)
        {
            $data['feature']=Features::find($id);
        }
        else{
            $data['feature']='';
        }
        return view('admin.features.create',$data);
    }   
    public function featuresAction(Request $request,$id=false)
    {
      
        //validate
        $request->validate([
            "feature_title"=>"required",
           
           
        ]);

    
       
        if($id)
        {
            $features = Features::find($id);
        }
        else{
        $features = new Features();
        }
        $features->feature_title = $request->feature_title;
        
       
       
        if($request->hasFile('feature_icon'))
        {
            
            $logo = $request->file('feature_icon');
            $filename = time().'_'.$logo->getClientOriginalName();
            $filePath = $logo->storeAs('icons', $filename, 'public');
            $logo->move("icons",$filePath);
            $features->feature_icon = $filename;
            
        }
        $features->save();
        
        return redirect(route('admin.features'))->with('success',"Features added Successfully..");
    } 
    public function featuresDelete(Request $request,$id)
    {
        if($id)
        {
            Features::where('id',$id)->delete();
            return back()->with('success',"Features deleted Successfully..");
        }
    }
}

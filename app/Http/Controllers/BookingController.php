<?php

namespace App\Http\Controllers;

use App\Models\Pool;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Hash;
class BookingController extends Controller
{
    //
    public function index()
    {
        return view('owner.booking.list');
    }
    public function list(Request $request)
    {
        $data=array();
        if ($request->ajax()) {
           
            $data = Booking::join('users','bookings.customer_id','=','users.id')
            ->join('pools','bookings.pool_id','=','pools.id')
            ->join('pool_slots','pool_slots.id','=','bookings.slot_id')
            ->where('pools.owner_id',"=",\Auth::user()->id)
            ->select('bookings.id','users.name','pools.pool_name','bookings.booking_date','pool_slots.slot','bookings.status')->orderBy('bookings.id','desc');

            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        if($row->status==2){    
                        $btn = '<a href="javascript:void(0)" onClick="approve(this)"  data-mode="approve"  data-id="'.$row->id.'" class="edit btn btn-success btn-sm">Approve</a>
                                <a href="javascript:void(0)" onClick="approve(this)"  data-mode="reject"   data-id="'.$row->id.'" class="edit btn btn-danger btn-sm">Reject</a>';
                        }
                        else{
                            $btn='';
                        }
                                return $btn;
                    })
                    ->editColumn('status',function($row){
                       
                          
                        return (($row->status==2)?'Pending':(($row->status==1)?'Approved':'Rejected'));
                    })
                    ->rawColumns(['action'])
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

        //validate
        $request->validate([
            "pool_id"=>"required",
            "booking_date"=>"required",
            "slot_id"=>"required",
        ]);

        $user_id = $request->customer_id?$request->customer_id:0;

        if($user_id==0)
        {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $cpr = $request->cpr;
            $user->password = Hash::make($request->phone);
            $user=$user->save();
            $user_id=\DB::getPdo()->lastInsertId();
            //$user_id=$user->id;
        }
        $booking = new Booking();
        $booking->pool_id = $request->pool_id;
        $booking->customer_id = $user_id;
        $booking->booking_date = $request->booking_date;
        $booking->slot_id = $request->slot_id;
        $booking->status = 2;
        $booking->save();
        
        
        return redirect(route('owner.booking.index'));
    }
}

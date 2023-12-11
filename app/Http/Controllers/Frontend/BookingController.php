<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Pool;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
class BookingController extends Controller
{
    //
    public function index()
    {
        return view('owner.booking.list');
    }
  
   public function bookPool($id=false)
   {
    $pool = Pool::find($id);
    return view('frontend.pool',compact('pool'));
   }
    public function bookPoolAction(Request $request)
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
        $booking->status = 1;
        $booking->save();
        
        
        return redirect(route('owner.booking.index'));
    }
}

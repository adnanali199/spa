<?php

namespace App\Models;
use App\Models\Pool;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    
    public function cutomer()
    {
        return $this->belongTo(User::class,'customer_id');
    }
    public function pools()
    {
        return $this->belongsToMany(Pool::class,'booking_details','booking_id','pool_id')->withPivot('booking_date', 'slot_id')->withTimestamps();
    }
    public function getOwnerBooking($pool_id=false)
    {
        $pools = Pool::where('owner_id',\Auth::user()->id);
        if($pool_id)
        {
            $pools->where('id',$pool_id);
        }
        $pools= $pools->get();
         $owner_pools = array();
         $i=0;
         foreach($pools as $pool)
         {
            $owner_pools[$i]=$pool->id; 
            $i++;
         }
          //dd($owner_pools);
        $events =  $this->join('users','bookings.customer_id','=','users.id')
        ->select('bookings.id','users.name','bookings.booking_date','bookings.status','bookings.booked_by')->orderBy('bookings.id')
        ->get();
        return $events;
        
    }
    public function getPoolBooking($pool_id)
    {

    }
   
    
}

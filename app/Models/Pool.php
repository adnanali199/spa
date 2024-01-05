<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PoolImages;
use App\Models\PoolFeatures;
use App\Models\PoolSchedule;
use DB;
class Pool extends Model
{
    use HasFactory;
    protected $fillable = [
        'pool_name',
        'short_name',
        'owner_id',
    ];
    public function images()
    {
        return $this->hasMany(PoolImages::class,'pool_id');
    }
    public function ownerPool()
    {$pools = $this->where('owner_id',\Auth::user()->id)->get();

        $owner_pools = array();
        $i=0;
        foreach($pools as $pool)
        {
           $owner_pools[$i]=$pool->id; 
           $i++;
        }
        //dd($owner_pools);
        return $owner_pools;
    }
    public function owner()
    {
        
        
            return $this->belongsTo(User::class, 'owner_id');
        
    }
    public function schedules()
    {
        return $this->hasMany(PoolSchedule::class,'pool_id');
    }
    public function bookings(): BelongsToMany
    {
        return $this->belongsToMany(bookings::class,'booking_details');
    }
   /**
    * Get all of the comments for the Pool
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
   public function features()
   {
       return $this->hasMany(Features::class, 'pool_id', 'id');
   }

   public function getSchedules($id,$date=false)
   {
        $pool = Pool::find($id);
        $date_unavailable = DB::table("pool_schedules")
        ->join("pool_schedule_slots","pool_schedules.id",'=','pool_schedule_slots.schedule_id')
        ->where('pool_schedules.pool_id',$pool->id)->select('date_available',DB::raw("COUNT(date_available) as total"),'slot_id')
        ->groupBy('date_available')
        ->where('date_available',$date)
        ->get();
    
     $dates=array();
     $nightsbooked = array();
     $daysbooked = array();
     
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
     return array("unavailable"=>$dates,"nightsbooked"=>$nightsbooked,"daysbooked"=>$daysbooked);
   }

}


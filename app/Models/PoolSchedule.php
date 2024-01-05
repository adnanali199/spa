<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserTypes;
use App\Models\PoolSchedule;
use App\Models\PoolScheduleSlots;
class PoolSchedule extends Model
{
    use HasFactory;
    protected $fillable = [
        'pool_id','date_available','start_time','end_time','status','booking_id'
    ];
    public function pool()
    {
            return $this->belongsTo(UserTypes::class,'user_type');
    }
    public function slots()
    {
            return $this->hasMany(PoolScheduleSlots::class,'schedule_id');
    }
}

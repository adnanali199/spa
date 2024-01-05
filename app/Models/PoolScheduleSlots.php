<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserTypes;
use App\Models\PoolSchedule;
class PoolScheduleSlots extends Model
{
    protected $table = "pool_schedule_slots";
    protected $fillable = [
        'schedule_id','slot_id','status'
    ];
    public function Schedule()
    {
            return $this->belongsTo(PoolSchedule::class,'schedule_id');
    }
}

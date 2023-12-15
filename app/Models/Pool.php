<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PoolImages;
use App\Models\PoolFeatures;
use App\Models\PoolSchedule;
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
    public function features()
    {
        return $this->hasMany(PoolFeatures::class);
    }
    public function schedules()
    {
        return $this->hasMany(PoolSchedule::class,'pool_id');
    }
    public function bookings()
    {
        return $this->hasMany(Booking::class,"pool_id");
    }
}


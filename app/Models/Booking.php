<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    public function getEvents()
    {
        
    }
    public function pool()
    {
        return $this->belongsTo(Pool::class,'pool_id');
    }
}

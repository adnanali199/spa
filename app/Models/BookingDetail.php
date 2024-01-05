<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingDetail extends Model
{
    use HasFactory;
    protected $table ='booking_details';
    protected $fillable = ['pool_id','booking_id','booking_date','slot_id'];

    
}

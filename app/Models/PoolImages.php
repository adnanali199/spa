<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoolImages extends Model
{
    use HasFactory;
    protected $fillable = [
        'pool_image','pool_id'
    ];
    public function pool()
    {
        
    }
}

<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\models\Pool;
use App\Models\Features;
class PoolFeatures extends Model
{
    
    use HasFactory;
    protected $table = "pool_features";
    protected $fillable = [
        'pool_id','feature_id','feature_value'
    ];
    public function pool()
    {
        return $this->belongsTo(Pool::class);
    }
    public function feature()
    {
        return $this->belongsTo(Features::class);
    }
}

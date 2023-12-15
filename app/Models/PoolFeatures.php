<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\models\Pool;
class PoolFeatures extends Model
{
    
    use HasFactory;
    protected $table = "pool_features";
    protected $fillable = [
        'pool_id','feature_title','feature_value','feature_icon'
    ];
    public function pool()
    {
        return $this->belongsTo(Pool::class);
    }
}

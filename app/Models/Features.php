<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Features extends Model
{
    use HasFactory;
    protected $table ="features";
    protected $fillable = [
        'feature_title','feature_icon'
    ];
    
       
        public function pools(): BelongsToMany
        {
            return $this->belongsToMany(Pool::class, 'pool_features', 'pool_id', 'feature_id');
        }
    
}

<?php

namespace App\Models;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
class Owner extends Model
{
  

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id','contract_no','cpr','iban'
       
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reason extends Model
{
    protected $fillable = [
        'reason', 'seller_id',
    ];
    public function seller(){
        return $this->belongsTo('App\Seller','seller_id');
    }
    public function reasons(){
        return $this->hasMany('App\User','user_id');
    }
}

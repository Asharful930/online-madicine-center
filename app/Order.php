<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id','total','status',];

    public function orderDetails(){
        return $this->hasMany('App\OrderDetail');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function shipment(){
        return $this->hasOne('App\Shipping');
    }

    public function payments(){
        return $this->hasMany('App\Payment');
    }
    public function ratings(){
        return $this->hasMany('App\Rating');
    }
}

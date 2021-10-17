<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['order_id','account_no','trx_id','amount','method','status'];

    public function order(){
        return $this->belongsTo('App\Order');
    }
}

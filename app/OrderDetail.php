<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable=['order_id','medicine_id','shop_id','quantity','subtotal','status'];

    public function medicine()
    {
        return $this->belongsTo('App\Medicine');
    }
    public function shop()
    {
        return $this->belongsTo('App\shop');
    }
    public function order()
    {
        return $this->belongsTo('App\Order');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = ['medicine_id','feedback','order_id','rating',];

    public function order(){
        return $this->belongsTo('App\Order');
    }
    public function medicine(){
        return $this->belongsTo('App\Medicine');
    }
}

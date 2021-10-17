<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class medicine extends Authenticatable
{
    use Notifiable;

    protected $guard = 'manager';

    protected $fillable = [
        'medicine_id', '', 'medicine_name', '', 'company_name', 'generic_name', 'medicine_type', 'medicine_price','description','image','shop_id',
    ];
    public function shop()
    {
        return $this->belongsTo('App\Shop');
    }
    public function ratings(){
        return $this->hasMany('App\Rating');
    }
}

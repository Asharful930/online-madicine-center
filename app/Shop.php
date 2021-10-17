<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\ShopResetPasswordNotification;
class Shop extends Authenticatable
{
    use Notifiable;

    protected $guard = 'sellers';

    protected $fillable = [
        'shop_name', 'm_name', 'm_email', 'password', 's_address', 's_contact', 'seller_id','latitude','longitude',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function seller()
    {
        return $this->belongsTo('App\Seller');
    }
    public function medicines()
    {
        return $this->hasMany('App\medicine');
    }

    public function orders()
    {
        return $this->hasMany('App\OrderDetail');
    }
    public function sendPasswordResetNotification($token)
  {
      $this->notify(new ShopResetPasswordNotification($token));
  }
}

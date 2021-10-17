<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\SellerResetPasswordNotification;
class Seller extends Authenticatable
{
    use Notifiable;

    protected $guard = 'sellers';

    protected $fillable = [
        'f_name', 'l_name', 'email', 'contact', 'password', 'nid', 'tin', 'is_active',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    public function shop()
    {
        return $this->hasMany('App\Shop');
    }
   
    
  //Send password reset notification
  public function sendPasswordResetNotification($token)
  {
      $this->notify(new SellerResetPasswordNotification($token));
  }
}

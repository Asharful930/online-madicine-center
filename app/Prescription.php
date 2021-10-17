<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    protected $fillable = [
        'name', 'contact','course','address','image','user_id','status',
    ];
    public function user(){
        return $this->hasMany('App\Prescription','user_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];
    public function details(){
        return $this->hasMany('App\Models\OrderDetails','order_id');
    }

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
}

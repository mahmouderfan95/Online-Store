<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    protected $guarded = [];
    public function order(){
        return $this->belongsTo('App\Models\Order');
    }
}

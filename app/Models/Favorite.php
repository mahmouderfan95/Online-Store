<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }

    public function product(){
        return $this->belongsTo('App\Models\Product','product_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function category(){
        return $this->belongsTo('App\Models\Category','category_id');
    }

    public function favorites(){
        return $this->hasMany('App\Models\Favorite','product_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    public function _parent(){
        return $this->belongsTo(self::class,'parent');
    }

    public function products(){
        return $this->hasMany('App\Models\Product','category_id');
    }
}

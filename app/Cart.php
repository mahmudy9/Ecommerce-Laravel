<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User' , 'user_id');
    }


    public function products()
    {
        return $this->belongsToMany('App\Product' , 'cart_item')->withPivot('price' , 'quantity' , 'uniqid');
    }
}

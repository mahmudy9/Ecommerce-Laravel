<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function category()
    {
        return $this->belongsTo('App\Category' , 'category_id');
    }

    public function brand()
    {
        return $this->belongsTo('App\Brand' , 'brand_id');
    }


    public function user()
    {
        return $this->belongsTo('App\User' , 'vendor_id');
    }


    public function reviews()
    {
        return $this->hasMany('App\Review' , 'product_id');
    }


    public function carts()
    {
        return $this->belongsToMany('App\Cart' , 'cart_item');
    }

    public function orders()
    {
        return $this->belongsToMany('App\Order' , 'order_item');
    }
}

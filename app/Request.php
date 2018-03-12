<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User' , 'cust_id');
    }


    public function product()
    {
        return $this->belongsTo('App\Product' , 'product_id');
    }

}

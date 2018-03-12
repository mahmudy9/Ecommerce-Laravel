<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name' , 'email' , 'password' , 'address' ,'city' , 'phone' ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function products()
    {
        return $this->hasMany('App\Product' , 'vendor_id');
    }


    public function contacts()
    {
        return $this->hasMany('App\Contact' , 'user_id');
    }


    public function orders()
    {
        return $this->hasMany('App\Order' , 'user_id');
    }


    public function carts()
    {
        return $this->hasMany('App\Cart' , 'user_id');
    }



    public function reviews()
    {
        return $this->hasMany('App\Review' , 'user_id');
    }


    public function comments()
    {
        return $this->hasMany('App\Comment' , 'user_id');
    }

    public function requests()
    {
        return $this->hasMany('App\Request' , 'cust_id');
    }

}

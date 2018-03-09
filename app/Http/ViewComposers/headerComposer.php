<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Cart;
use Illuminate\Support\Facades\DB;

class headerComposer
{


    public function __construct()
    {

    }


    public function compose(View $view)
    {
        if(Auth::id())
        {
            $id = Auth::id();
            if(Cart::where('user_id' , $id)->exists())
            {
                $cart = Cart::where('user_id' , $id )->get(['id']);
                $cart_id = $cart[0]->id;
                $count = DB::table('cart_item')->where('cart_id' , $cart_id)->count();
            }else{
                $count = 0;
            }
        }else{
            $count = 0;
        }

        $view->with('count' , $count);

    }


}
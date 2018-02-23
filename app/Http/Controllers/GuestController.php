<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Review;
use App\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GuestController extends Controller
{
    public function showproduct($id)
    {
        $product = Product::find($id);
        $reviews = Review::where('product_id' , $id)->get();
        if(Auth::id())
        {
            $user_id = Auth::id();
            if(Cart::where('user_id' , $user_id)->exists())
            {
                $cart = Cart::where('user_id' , $user_id )->get(['id']);
                $cart_id = $cart[0]->id;
                $count = DB::table('cart_item')->where('cart_id' , $cart_id)->count();
            }

        }
        return view('product' , compact('product' , 'reviews' , 'count'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth' , 'User' ]);
    }


    public function index()
    {
        $user_id = Auth::id();
        if(Cart::where('user_id' , $user_id)->exists())
        {
            $cart = Cart::where('user_id' , $user_id )->get(['id']);
            $cart_id = $cart[0]->id;
            $count = DB::table('cart_item')->where('cart_id' , $cart_id)->count();
        }


        return view('user.dashboard' , compact('count') );
    }


    public function add_to_cart($product_id)
    {
        //check if cart exists
        if(Cart::where('user_id' , Auth::id())->exists())
        {
            $cart = DB::table('carts')->where('user_id' , Auth::id())->get(['id']);
            $cart_id = $cart[0]->id;
        }
        else
        {
            $cart = new Cart;
            $cart->user_id = Auth::id();
            $cart->save();
            $cart_id = $cart->id;
        }
        
        $product = Product::find($product_id);
        DB::table('cart_item')->insert([
            'cart_id' => $cart_id,
            'product_id' => $product->id,
            'quantity' => '1',
            'price' => $product->price
        ]);

        $count = DB::table('cart_item')->where('cart_id' , $cart_id)->count();

        return response()->json(['count' => $count]);
    }
}

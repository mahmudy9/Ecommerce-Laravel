<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\Product;
use App\User;
use App\Order;
use App\Review;
use App\Request as Req;
use Validator;
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
        return view('user.dashboard');
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
        if($product->approved != 1)
        {
            abort(404);
        }
        $items_count = DB::table('cart_item')->where([
            ['product_id' , '=' , $product->id],
            ['cart_id' , '=' , $cart_id]
            ])->count();
        if($items_count >= $product->quantity)
        {
            return response()->json([] , 400);
        }
        $uniq = uniqid('cartid' , true);
        $uniqid = str_replace('.' , '' , $uniq);
        DB::table('cart_item')->insert([
            'uniqid' => $uniqid,
            'cart_id' => $cart_id,
            'product_id' => $product->id,
            'quantity' => 1,
            'price' => $product->price,
        ]);
        $count = DB::table('cart_item')->where('cart_id' , $cart_id)->count();

        return response()->json(['count' => $count],200);
    }



    public function mycart()
    {
        $id = Auth::id();
        if(Cart::where('user_id' , $id)->exists())
        {
            $cart = Cart::where('user_id' , $id)->get(['id']);
            $cart_id = $cart[0]->id;
        }
        else
        {
            $cart = new Cart;
            $cart_id = $cart->id;
        }

        $carty = Cart::find($cart_id);

        return view('user.mycart' , compact('carty'));
    }


    public function destroy_cart_item($id)
    {
        DB::table('cart_item')->where('uniqid' , $id)->delete();
        return response()->json([] , 200);
    }


    public function proceed_to_checkout()
    {

        if(Cart::where('user_id' , Auth::id())->exists())
        {
            $cart = Cart::where('user_id' , Auth::id())->get(['id']);
            $cart_id = $cart[0]->id;
            if(DB::table('cart_item')->where('cart_id' , $cart_id)->count() == 0)
            {
                return redirect('/user/cart');
            }
        }
        else
        {
            return redirect('/user/cart');   
        }

        $user = Auth::user();
        return view('user.checkout' , compact('user'));
    }

    public function confirminfo(Request $request)
    {
        

        $validator = Validator::make($request->all() , [
            'city' => 'required|min:3',
            'address' => 'required|min:10',
            'phone' => 'required|min:8|numeric'
        ]);

        if($validator->fails())
        {
            return redirect()
            ->back()
            ->withErrors($validator);
        }

        $user = Auth::user();
        $user->city = $request->input('city');
        $user->address = $request->input('address');
        $user->phone = $request->input('phone');
        $user->save();

        return redirect('/user/pay');
    }


    public function pay()
    {
        if(Cart::where('user_id' , Auth::id())->exists())
        {
            $cart = Cart::where('user_id' , Auth::id())->get(['id']);
            $cart_id = $cart[0]->id;
            if(DB::table('cart_item')->where('cart_id' , $cart_id)->count() == 0)
            {
                return redirect('/user/cart');
            }
        }
        else
        {
            return redirect('/user/cart');   
        }

        $cart = Cart::where('user_id' , Auth::id())->get(['id']);
        $cart_id = $cart[0]->id;
        $carts = Cart::find($cart_id);
        return view('user.pay' , compact('carts'));
    }


    public function charge(Request $request)
    {
        $cart = Cart::where('user_id' , Auth::id())->get(['id']);
        $cart_id = $cart[0]->id;
        $carts = Cart::find($cart_id);
        $total = 0;
        foreach($carts->products as $item)
        {
            $total = $total + $item->pivot->price;
        }

        
        // Set your secret key: remember to change this to your live secret key in production
        // See your keys here: https://dashboard.stripe.com/account/apikeys
        \Stripe\Stripe::setApiKey("sk_test_uGa7jlgC6kwKBXOS9f62zv1l");

        // Token is created using Checkout or Elements!
        // Get the payment token ID submitted by the form:
        $token = $request->input('stripeToken');

        // Charge the user's card:
        $charge = \Stripe\Charge::create(array(
        "amount" => $total*100,
        "currency" => "usd",
        "description" => "Example charge",
        "source" => $token,
        ));
        if($charge)
        {
            $order = new Order;
            $order->user_id = Auth::id();
            $order->total = $total;
            $order->save();
            foreach($carts->products as $item)
            {
                $uniq = uniqid('orderid' , true);
                $uniqid = str_replace('.' , '' , $uniq);
                DB::table('order_item')->insert([
                    'uniqid' => $uniqid,
                    'order_id' => $order->id,
                    'product_id' => $item->id,
                    'vendor_id' => $item->vendor_id,
                    'quantity' => $item->pivot->quantity,
                    'price' => $item->pivot->price
                ]);

                $request = new Req;
                $request->uniqid = $uniqid;
                $request->cust_id = Auth::id();
                $request->vendor_id = $item->vendor_id;
                $request->product_id = $item->id;
                $request->quantity = $item->pivot->quantity;
                $request->save(); 

                $product = Product::find($item->id);
                $qty = $product->quantity - 1;
                $product->quantity = $qty;
                $product->save();

            }
            DB::table('cart_item')->where('cart_id' , $cart_id)->delete();
            return redirect('/user/orders');
        }
    }


    public function orders()
    {
       
        $orders = Order::where('user_id' , Auth::id())->get();
        
        return view('user.orders' , compact('orders'));
    }

    public function order_detail($id)
    {
        $details = Order::find($id);
        if($details->user_id != Auth::id())
        {
            return abort(404);
        }
        return view('user.orderdetail' , compact('details'));
    }


    public function write_review($id)
    {
        $orderitem = DB::table('order_item')->where('uniqid' , $id)->get();
        $order = Order::find($orderitem[0]->order_id);
        $user_id = $order->user_id;
        if(Auth::id() != $user_id)
        {
            return abort(404);
        }
        if($orderitem[0]->reviewed == 1)
        {
            return abort(404);
        }
        $product = Product::find($orderitem[0]->product_id);
        return view('user.review' , compact('product' , 'id'));
    }


    public function post_review(Request $request)
    {
        $validator = Validator::make($request->all() , [
            'review' => 'required|min:12|max:400',
            'id' => 'required'
        ]);

        if($validator->fails())
        {
            return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
        }

        $orderitem = DB::table('order_item')->where('uniqid' , $request->input('id'))->get();

        $order = Order::find($orderitem[0]->order_id);
        if($order->user_id != Auth::id() || $orderitem[0]->reviewed == 1 )
        {
            return abort(404);
        }

        $item = DB::table('order_item')->where('uniqid' , $request->input('id'))->update(['reviewed' => 1]);

        $review = new Review;
        $review->user_id = Auth::id();
        $review->product_id = $orderitem[0]->product_id;
        $review->uniqid = $request->input('id');
        $review->body = $request->input('review');
        $review->approved = 0;
        $review->save();
        return redirect('/user/orders');
    }



    public function settings()
    {
        $user = User::find(Auth::id());
        return view('user.settings' , compact('user'));
    }


    public function store_settings(Request $request)
    {
        $validator = Validator::make($request->all() , [
            'name' => 'required|min:6',
            'email' => 'required|email',
            'address' => 'required|min:8',
            'city' => 'required|min:4',
            'phone' => 'required|min:8|numeric'
        ]);

        if($validator->fails())
        {
            return redirect()
            ->back()
            ->withErrors($validator);
        }

        $user = User::find(Auth::id());
        $user->email = $request->input('email');
        $user->name = $request->input('name');
        $user->address = $request->input('address');
        $user->city = $request->input('city');
        $user->phone = $request->input('phone');
        $user->save();
        $request->session()->flash('status' , 'Data Updated');
        return redirect()->back();
    }


}

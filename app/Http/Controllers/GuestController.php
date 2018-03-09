<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Review;
use App\Cart;
use App\Post;
use App\Contact;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GuestController extends Controller
{
    
    
    public function showproduct($id)
    {
        $product = Product::find($id);
        $reviews = Review::where('product_id' , $id)->get();

        return view('product' , compact('product' , 'reviews'));
    }


    public function blog()
    {
        $posts = Post::paginate(6);
        return view('blog' , compact('posts'));
    }


    public function contact()
    {
        return view('contact');
    }


    public function storecontact(Request $request)
    {
        $validator = Validator::make($request->all() , [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'message' => 'required|min:10|string'
        ]);

        if($validator->fails())
        {
            return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
        }

        $contact = new Contact;
        if(Auth::user())
        {
            $contact->name = Auth::user()->name;
            $contact->email = Auth::user()->email;
            $contact->user_id = Auth::id();
            $contact->message = $request->input('message');
        }
        else
        {

            $contact->name = $request->input('name');
            $contact->email = $request->input('email');
            $contact->message = $request->input('message');
        }
        $contact->save();
        $request->session()->flash('status' , 'Message Sent to Admin');
        return redirect()->back();
    }


    public function about()
    {
        return view('about');
    }
}

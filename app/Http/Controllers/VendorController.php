<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\Request as Req;
use App\User;
use App\Product;

class VendorController extends Controller
{
    
    use RegistersUsers;

    public function __construct()
    {
        $this->middleware(['auth' , 'Vendor'])->except(['show_register' , 'vendor_register']);
    }

    public function show_register()
    {
        return view('vendor.register');
    }


    public function vendor_register(Request $request)
    {
        $validator = Validator::make($request->all() , [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'address' => 'required|string|min:8',
            'city' => 'required|string|min:4',
            'phone' => 'required|min:8'
        ]);

        if($validator->fails())
        {
            return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
        }
        //dd($request);

        $user = New User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->address = $request->input('address');
        $user->city = $request->input('city');
        $user->phone = $request->input('phone');
        $user->isvendor = '1';

        $user->save();
        $request->session()->flash('status' , "You're now registered , you may now login" );
        $request->session()->reflash();
        return redirect()->back();
    }



    public function dashboard()
    {
        $requests = Req::where('vendor_id' , Auth::id())->latest()->paginate(10);

        return view('vendor.orderrequests' , compact('requests'));
    }


    public function create_product()
    {
        return view('vendor.createproduct');
    }


    public function store_product(Request $request)
    {
        if($request->hasFile('image'))
        {
        $path = $request->file('image')->store('public/products');
        $filetostore = pathinfo($path , PATHINFO_BASENAME);
        }
        $validator = Validator::make($request->all() , [
            'name' => 'required|min:3|unique:brands,name',
            'description' => 'required|min:8',
            'category' => 'required|integer',
            'brand' => 'required|integer',
            'image' => 'required|image|max:1999',
            'price' => 'required|numeric',
            'quantity' => 'required|integer'
        ]);

        if($validator->fails())
        {
            return redirect()
            ->back()
            ->withInput()
            ->withErrors($validator);
        }

        $product = new Product;
        $product->vendor_id = Auth::id();
        $product->category_id = $request->input('category');
        $product->brand_id = $request->input('brand');
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->quantity = $request->input('quantity');
        $slug = strtolower(str_replace(' ' , '-' , $request->input('name')));
        $slug2 = str_replace('/' , '-' , $slug);
        $product->slug = str_replace("\\" , '-', $slug2 );
        $product->img = $filetostore;
        $product->price = $request->input('price');
        $product->approved = '0';
        $product->save();
        $request->session()->flash('status' , 'Product Has Been Added');
        
        return redirect()->back();
    }


    public function myproducts()
    {
        $products = Product::where([
            'vendor_id' => Auth::id(),
            ])->paginate(10);
        
        return view('vendor.products' , compact('products'));
    }


    public function myapproved()
    {
        $products = Product::where([
            'vendor_id' => Auth::id(),
            'approved' => 1
        ])->paginate(10);

        return view('vendor.approved' , compact('products') );
    }


    public function mydisapproved()
    {
        $products = Product::where([
                'vendor_id' => Auth::id(),
                'approved' => 0
            ])->paginate(10);

        return view('vendor.disapproved' , compact('products') );
        
    }


    public function editproduct($id)
    {
        $product = Product::find($id);
        if($product->approved != 0 || $product->vendor_id != Auth::id())
        {
            abort(404);
        }

        return view('vendor.editproduct' , compact('product'));
    }



    public function update_product( $id , Request $request)
    {

        $product = Product::find($id);
        if($product->approved != 0 || $product->vendor_id != Auth::id())
        {
            abort(404);
        }


        if($request->hasFile('image'))
        {
        $path = $request->file('image')->store('public/products');
        $filetostore = pathinfo($path , PATHINFO_BASENAME);
        }
        $validator = Validator::make($request->all() , [
            'name' => 'required|min:3|unique:brands,name',
            'description' => 'required|min:8',
            'category' => 'required|integer',
            'brand' => 'required|integer',
            'image' => 'image|max:1999',
            'price' => 'required|numeric',
            'quantity' => 'required|integer'
        ]);

        if($validator->fails())
        {
            return redirect()
            ->back()
            ->withErrors($validator);
        }


        $product->vendor_id = Auth::id();
        $product->category_id = $request->input('category');
        $product->brand_id = $request->input('brand');
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->quantity = $request->input('quantity');
        $slug = strtolower(str_replace(' ' , '-' , $request->input('name')));
        $slug2 = str_replace('/' , '-' , $slug);
        $product->slug = str_replace("\\" , '-', $slug2 );
        if($request->hasFile('image'))
        {
        $product->img = $filetostore;
        }
        $product->price = $request->input('price');
        $product->save();
        $request->session()->flash('status' , 'Product Has Been updated');
        
        return redirect()->back();

    }


    public function settings()
    {
        $user = User::find(Auth::id());
        return view('vendor.settings' , compact('user'));
    }


    public function update_settings(Request $request)
    {

        $validator = Validator::make($request->all() , [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'address' => 'required|min:10',
            'city' => 'required|min:4',
            'phone' => 'required|numeric'
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


    public function change_pass()
    {
        return view('vendor.password');
    }

    public function post_pass(Request $request)
    {
        $validator = Validator::make($request->all() , [
            'old_pass' => 'required',
            'password' => 'required|min:6|confirmed'
        ]);
        if($validator->fails())
        {
            return redirect()
            ->back()
            ->withErrors($validator);
        }
        $user = User::find(Auth::id());
        if(Hash::check($request->input('old_pass') , $user->password))
        {   
            $user->password = Hash::make($request->input('password'));
            $user->save();
            $request->session()->flash('status' , 'Password Changed');
            return redirect()->back();

        }
            $request->session()->flash('status' , 'Wrong Password');
            return redirect()->back();


    }

}

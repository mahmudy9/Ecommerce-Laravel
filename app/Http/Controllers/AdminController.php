<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Product;
use App\Brand;
use App\Category;
use App\Contact;
use App\Subscriber;
use App\Order;
Use App\Post;
use App\Request as Req;
use App\Review;
use App\User;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth' , 'Admin']);
    }


    public function index()
    {
        $requests = Req::where('vendor_id' , Auth::id())->latest()->paginate(10);


        return view('admin.index' ,compact('requests'));
    }


    public function create_product()
    {
        $categories = Category::all();
        $brands = Brand::all();
        $products = Product::where('vendor_id' , Auth::id())->paginate(6);
        return view('admin.create_product' , compact( 'products' ,'categories' , 'brands'));
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
        $product->approved = '1';
        $product->seen = 1;
        $product->save();
        $request->session()->flash('status' , 'Product Has Been Added');
        
        return redirect()->back();
    }



    public function create_category()
    {
        $categories = Category::latest()->get();


        return view('admin.addcategory' , compact('categories'));
    }


    public function store_category(Request $request)
    {
        $validator = Validator::make($request->all() , [
            'name' => 'required|min:3|unique:categories,name',
            'description' => 'required|min:8'
        ]);

        if($validator->fails())
        {
            return redirect()
            ->back()
            ->withInput()
            ->withErrors($validator);
        }

        $category = new Category;
        $category->name = $request->input('name');
        $category->description = $request->input('description');
        $category->save();
        $request->session()->flash('status' , 'Category Has Been Added');
        
        return redirect()->back();
    }


    public function destroy_category($id)
    {
        if(Product::where('category_id' , $id)->exists())
        {
            return response()->json([] , 400);
        }
        $category = Category::find($id);
        $category->delete();
        return response()->json(['success' => 'Category Deleted'] , 200);
    }


    public function create_brand()
    {
        $brands = Brand::latest()->get();
        return view('admin.addbrand', compact('brands' , 'categories'));
    }

    public function store_brand(Request $request)
    {
        $validator = Validator::make($request->all() , [
            'name' => 'required|min:3|unique:brands,name',
            'description' => 'required|min:8'
        ]);

        if($validator->fails())
        {
            return redirect()
            ->back()
            ->withInput()
            ->withErrors($validator);
        }

        $brand = new Brand;
        $brand->name = $request->input('name');
        $brand->description = $request->input('description');
        $brand->save();
        $request->session()->flash('status' , 'Brand Has Been Added');
        
        return redirect()->back();
    }


    public function destroy_brand($id)
    {
        if(Product::where('brand_id' , $id)->exists())
        {
            return response()->json(['fail' => 'can\'t delete brand'] , 400 );
        }
        $brand = Brand::find($id);
        $brand->delete();
        return response()->json(['success' => 'brand deleted'] , 200);
    }



    public function disapprove_product($id)
    {
        $product = Product::find($id);
        $product->approved = 0;
        $product->save();
        return response()->json([] , 200);
    }


    public function my_approved_products()
    {
        $products = Product::where(['vendor_id' => Auth::id() , 'approved' => 1 ])->paginate(9);
        return view('admin.myapproved' , compact('products'));
    }


    public function my_disapproved_products()
    {
        $products = Product::where(['vendor_id' => Auth::id() , 'approved' => 0 ])->paginate(9);
        return view('admin.mydisapproved' , compact('products'));
    }


    public function approve_product($id)
    {
        $product = Product::find($id);
        $product->approved = 1;
        $product->save();
        return response()->json([] , 200);
    }


    public function approve_products()
    {
        $products = Product::where([ 'approved' => 0 ,'seen' => 0])->paginate(9);
        return view('admin.approveproducts' , compact('products') );
    }


    public function seen($id)
    {
        $product = Product::find($id);
        $product->seen = 1;
        $product->save();
        return response()->json([] , 200);
    }


    public function show_product($id)
    {
        $product = Product::find($id);
        return view('admin.showproduct' , compact('product'));
    }


    public function approved_products()
    {
        $products = Product::where('approved' , 1)->paginate(9);
        return view('admin.approvedproducts' , compact('products'));
    }


    public function disapproved_products()
    {
        $products = Product::where('approved' , 0)->paginate(9);
        return view('admin.disapprovedproducts' , compact('products'));
    }



    public function approve_reviews()
    {
        $reviews = Review::where('approved' , '0')->paginate(10);
        return view('admin.approvereviews' , compact('reviews'));
    }



    public function approved_reviews()
    {
        $reviews = Review::where('approved' , '1')->paginate(10);
        return view('admin.approvedreviews' , compact('reviews'));
        
    }


    public function approve_review($id)
    {
        $review = Review::find($id);
        $review->approved = 1;
        $review->save();
        return response()->json([] , 200);
    }


    public function disapprove_review($id)
    {
        $review = Review::find($id);
        $review->approved = 0;
        $review->save();
        return response()->json([] , 200);
    }


    public function delete_review($id)
    {
        $review = Review::find($id);
    
        $review->delete();
        return response()->json([] , 200);
    }


    public function create_post()
    {
        return view('admin.createpost');
    }


    public function store_post(Request $request)
    {
        $validator = Validator::make($request->all() , [
            'title' => 'required|min:10|max:255',
            'body' => 'required|min:140'
        ]);
        if($validator->fails())
        {
            return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
        }
        $post = new Post;
        $post->user_id = Auth::id();
        $post->title = $request->input('title');
        $slug = str_replace(' ' , '-' , $request->input('title'));
        $slug2 = str_replace('/' , '-' , $slug);
        $slug3 = str_replace('\\' , '-' , $slug2);
        $post->slug = $slug3;
        $post->body = $request->input('body');
        $post->save();
        $request->session()->flash('status' , 'Post published');
        return redirect()->back();
    }


    public function posts_list()
    {
        $posts = Post::paginate(10);
        return view('admin.posts' , compact('posts'));
    }


    public function delete_post($id)
    {
        $post = Post::find($id);
        $post->delete();
        return response()->json([] , 200);
    }


    public function edit_post($id)
    {
        $post = Post::find($id);
        return view('admin.editpost' , compact('post'));
    }


    public function update_post(Request $request)
    {
        $post = Post::find($request->input('id'));
        $post->title = $request->input('title');
        $slug = str_replace(' ' , '-' , $request->input('title'));
        $slug2 = str_replace('/' , '-' , $slug);
        $slug3 = str_replace('\\' , '-' , $slug2);
        $post->slug = $slug3;
        $post->body = $request->input('body');
        $post->save();
        $request->session()->flash('status' , 'Post Updated');
        return redirect()->back();

    }


    public function settings()
    {
        $user = User::find(Auth::id());
        return view('admin.settings' , compact('user'));
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
        return view('admin.password');
    }



    public function update_pass(Request $request)
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


    public function view_orders()
    {
        $requests = Req::latest()->paginate('10');

        return view('admin.allrequests' , compact('requests'));
    }


    public function view_users()
    {
        $users = User::where(['isadmin' => 0, 'isvendor' => 0])->paginate(20);
        return view('admin.viewusers' , compact('users'));
    }


    public function view_vendors()
    {
        $vendors = User::where('isvendor' , 1)->paginate(20);
        return view('admin.viewvendors' , compact('vendors'));
    }


    public function view_contacts()
    {
        $contacts = Contact::latest()->paginate(10);
        return view('admin.viewcontacts' , compact('contacts'));
    }


    public function view_subs()
    {
        $subs = Subscriber::paginate(20);
        return view('admin.viewsubs' , compact('subs'));
    }


    public function delete_sub($id)
    {
        $sub = Subscriber::find($id);
        $sub->delete();
        return response()->json([] , 200);
    }


    public function delete_contact($id)
    {
        $sub = Contact::find($id);
        $sub->delete();
        return response()->json([] , 200);
    }


}

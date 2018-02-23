<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Product;
use App\Brand;
use App\Category;
use App\Contact;
use App\Subscriber;
use App\Order;
Use App\Post;

class AdminController extends Controller
{
    public function __construct()
    {

    }


    public function index()
    {


        return view('admin.index');
    }


    public function create_product()
    {
        $categories = Category::all();
        $brands = Brand::all();
        $products = Product::all();
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
        $product->save();
        $request->session()->flash('status' , 'Product Has Been Added');
        
        return redirect()->back();
    }


    public function dstroy_product($id)
    {

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
        $category = Category::find($id);
        $category->delete();
        return response()->json(['success' => 'Category Deleted']);
    }


    public function create_brand()
    {
        $brands = Brand::latest()->get();
        $categories = Category::all();
        return view('admin.addbrand', compact('brands' , 'categories'));
    }

    public function store_brand(Request $request)
    {
        $validator = Validator::make($request->all() , [
            'name' => 'required|min:3|unique:brands,name',
            'description' => 'required|min:8',
            'category' => 'required|numeric'
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
        $brand->category_id = $request->input('category');
        $brand->save();
        $request->session()->flash('status' , 'Brand Has Been Added');
        
        return redirect()->back();
    }


    public function destroy_brand($id)
    {
        $brand = Brand::find($id);
        $brand->delete();
        return response()->json(['success' => 'brand deleted']);
    }

}

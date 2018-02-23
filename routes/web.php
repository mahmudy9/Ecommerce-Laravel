<?php
use App\Product;
use App\Cart;
Use Illuminate\Support\Facades\DB;
Use Illuminate\Support\Facades\Auth;
use App\User;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['middleware' => 'nocache'] ,function(){ 

Route::get('/', function () {
    $products = Product::latest()->get();
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

    return view('home' , compact('products' , 'count') );
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/product/{id}/{slug}' , 'GuestController@showproduct');

Route::get('/vendor/register' , 'VendorController@show_register')->name('vendor.register');
Route::post('/vendor/register/post' , 'VendorController@vendor_register')->name('vendor.post.register');

Route::post('/addtocart/{product_id}' , 'UserController@add_to_cart');
Route::post('/user/mycart' , 'UserController@mycart');
Route::get('user/dashboard' , 'UserController@index');
Route::get('/paypal' , function(){
    return view('paypal');
});

Route::get('/pay' , function(){
   

    
})->name('paypal');


Route::get('/admin/dashboard' , 'AdminController@index');
Route::get('/admin/createproduct' , 'AdminController@create_product');
Route::post('/admin/storeproduct' , 'AdminController@store_product');
Route::post('/admin/destroyproduct' , 'AdminController@destroy_product');
Route::get('/admin/createcategory' , 'AdminController@create_category');
Route::post('/admin/createcategory2' , 'AdminController@store_category');
Route::post('/admin/destroycategory/{id}' , 'AdminController@destroy_category');
Route::get('/admin/createbrand' , 'AdminController@create_brand');
Route::post('/admin/storebrand' , 'AdminController@store_brand');
Route::post('/admin/destroybrand/{id}' , 'AdminController@destroy_brand');
});
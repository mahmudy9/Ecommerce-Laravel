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
    return view('home' , compact('products') );
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/product/{id}/{slug}' , 'GuestController@showproduct');
Route::get('/post/{id}/{slug}' , 'GuestController@showpost');
Route::get('/blog' , 'GuestController@blog');
Route::get('/contact' , 'GuestController@contact');
Route::post('/storecontact' , 'GuestController@storecontact');
Route::get('/about' , 'GuestController@about');



Route::get('/vendor/register' , 'VendorController@show_register')->name('vendor.register');
Route::post('/vendor/register/post' , 'VendorController@vendor_register')->name('vendor.post.register');

Route::post('/addtocart/{product_id}' , 'UserController@add_to_cart');
Route::get('/user/cart' , 'UserController@mycart');
Route::post('/cart/destroy/{id}' , 'UserController@destroy_cart_item');
Route::get('user/checkout' , 'UserController@proceed_to_checkout');
Route::post('user/confirminfo' , 'UserController@confirminfo');
Route::get('user/pay' , 'UserController@pay');
Route::post('user/charge' , 'UserController@charge');
Route::get('user/orders' , 'UserController@orders');
Route::get('user/orders/{id}' , 'UserController@order_detail');
Route::get('user/review/{id}' , 'UserController@write_review');
Route::post('user/postreview' , 'UserController@post_review');
Route::get('user/dashboard' , 'UserController@index');

Route::get('/admin/dashboard' , 'AdminController@index');
Route::get('/admin/createproduct' , 'AdminController@create_product');
Route::post('/admin/storeproduct' , 'AdminController@store_product');
Route::post('/admin/destroyproduct/{id}' , 'AdminController@destroy_product');
Route::get('/admin/createcategory' , 'AdminController@create_category');
Route::post('/admin/createcategory2' , 'AdminController@store_category');
Route::post('/admin/destroycategory/{id}' , 'AdminController@destroy_category');
Route::get('/admin/createbrand' , 'AdminController@create_brand');
Route::post('/admin/storebrand' , 'AdminController@store_brand');
Route::post('/admin/destroybrand/{id}' , 'AdminController@destroy_brand');
});
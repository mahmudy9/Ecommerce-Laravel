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

Route::get('/', function () 
{
    $products = Product::where('approved' , 1)->latest()->paginate(9);
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
Route::post('/subscribe' , 'GuestController@subscribe');
Route::get('/category/{id}/{slug}' , 'GuestController@category');
Route::get('/brand/{id}/{slug}' , 'GuestController@brand');


Route::get('/vendor/register' , 'VendorController@show_register')->name('vendor.register');
Route::post('/vendor/register/post' , 'VendorController@vendor_register')->name('vendor.post.register');
Route::get('/vendor/dashboard' , 'VendorController@dashboard' );
Route::get('/vendor/createproduct' , 'VendorController@create_product');
Route::post('/vendor/storeproduct' , 'VendorController@store_product');
Route::get('/vendor/myproducts' , 'VendorController@myproducts');
Route::get('/vendor/myapproved' , 'VendorController@myapproved');
Route::get('/vendor/mydisapproved' , 'VendorController@mydisapproved');
Route::get('/vendor/editproduct/{id}' , 'VendorController@editproduct');
Route::post('/vendor/updateproduct/{id}' , 'VendorController@update_product');
Route::get('/vendor/mysettings' , 'VendorController@settings');
Route::post('/vendor/updatesettings' , 'VendorController@update_settings');
Route::get('/vendor/changepass' , 'VendorController@change_pass');
Route::post('/vendor/postpass' , 'VendorController@post_pass');
Route::get('/vendor/{id}' , 'GuestController@vendor');


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
Route::get('user/settings' , 'UserController@settings');
Route::post('user/storesettings' , 'UserController@store_settings');
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
Route::post('admin/disapprove/{id}' , 'AdminController@disapprove_product');
Route::get('admin/myapproved-products' , 'AdminController@my_approved_products');
Route::get('admin/mydisapproved-products' , 'AdminController@my_disapproved_products');
Route::post('admin/approve-product/{id}' , 'AdminController@approve_product');
Route::get('admin/approve-products' , 'AdminController@approve_products');
Route::post('admin/seen/{id}' , 'AdminController@seen');
Route::get('admin/showproduct/{id}' , 'AdminController@show_product');
Route::get('/admin/approved-products' , 'AdminController@approved_products');
Route::get('/admin/disapproved-products' , 'AdminController@disapproved_products');
Route::get('/admin/approvereviews' , 'AdminController@approve_reviews');
Route::get('admin/approvedreviews' , 'AdminController@approved_reviews');
Route::post('admin/approvereview/{id}' , 'AdminController@approve_review');
Route::post('admin/deletereview/{id}' , 'AdminController@delete_review');
Route::post('/admin/disapprovereview/{id}' , 'AdminController@disapprove_review');
Route::get('/admin/createpost' , 'AdminController@create_post');
Route::post('/admin/storepost' , 'AdminController@store_post');
Route::get('/admin/posts' , 'AdminController@posts_list');
Route::post('/admin/deletepost/{id}' , 'AdminController@delete_post');
Route::get('/admin/editpost/{id}' , 'AdminController@edit_post' );
Route::post('/admin/updatepost' , 'AdminController@update_post' );
Route::get('/admin/settings' , 'AdminController@settings');
Route::post('/admin/updatesettings' , 'AdminController@update_settings');
Route::get('/admin/password' , 'AdminController@change_pass');
Route::post('/admin/updatepass' , 'AdminController@update_pass');
Route::get('admin/vieworders' , 'AdminController@view_orders');
Route::get('admin/viewusers'  , 'AdminController@view_users');
Route::get('admin/viewvendors' , 'AdminController@view_vendors');
Route::get('admin/viewcontacts' , 'AdminController@view_contacts');
Route::get('admin/viewsubscribers' , 'AdminController@view_subs');
Route::post('admin/deletecontact/{id}' , 'AdminController@delete_contact');
Route::post('admin/deletesubscriber/{id}' , 'AdminController@delete_sub');

});
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use App\User;

class VendorController extends Controller
{
    
    use RegistersUsers;

    public function __construct()
    {
        //$this->middleware('guest');
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

}

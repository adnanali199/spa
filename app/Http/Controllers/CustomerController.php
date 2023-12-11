<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function __construct()
    {
       
       // $this->middleware('owner');
    }
    //
    public function index()
    {
        return view('customer.index');
    }
    public function login()
    {
        return view('customer.auth.login');
    }
    public function register()
    {
        return view('customer.auth.register');
    }
    public function loginAction(Request $request)
    {
        //validate
        $request->validate([
            
            "phone"=>"required",
            "password"=>"required"
        ]);
        //login user here
        if(Auth::attempt($request->only('phone','password')))
        {
            return redirect(route('/'));
        }
         return redirect()->back()->with('error',"Ivalid login");
    }
    public function registerAction(Request $request)
    {
        //validate
        $request->validate([
            "name"=>"required|min:5",
            "phone"=>"required",
            "email"=>"required|email|unique:users",
            "password"=>"required|confirmed|min:8"
        ]);
        //save owner data in users table
        $user = new User();
        User::create([
            $user->name      =  $request->name,
            $user->email     =  $request->email,
            $user->phone          = $request->phone,
            $user->cpr       =  $request->cpr,
            $user->password  =  Hash::make($request->password),
            $user->address   =  $request->address,
            $user->user_type =  2

        ]);
        //login user here
        if(Auth::attempt($request->only('email','password')))
        {
            return redirect(route('owner.index'));
        }
        return redirect('owner.register')->withErrors();
    }
}

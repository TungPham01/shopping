<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //
    public function loginAdmin() {
        if(Auth::check()){
            return redirect()->to('home');
        }
        return view('admin.login');
    }

    public function postLoginAdmin(Request $request) {
        $remember = $request->has('remember_me') ? true :false;
        if(Auth::attempt([
            'email'=>$request->email,
            'password'=>$request->password
        ],$remember)){
            return redirect()->to('home');
        }else{
            return redirect()->to('admin')->with('status','Sai tài khoản!');
        }
    }

    public function  logoutAdmin (){
        Auth::logout();
        return redirect()->to('admin');
    }
}

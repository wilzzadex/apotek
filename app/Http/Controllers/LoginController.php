<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('auths.index');
    }

    public function postlogin(Request $request)
    {
        if(Auth::attempt($request->only('username','password')))
        {
            if(auth()->user()->role == 'Admin'){
                return redirect(url('dashboard'));
            }elseif(auth()->user()->role == 'Kasir'){
                return redirect(url('kasirpage'));
            }elseif(auth()->user()->role == 'Apoteker'){
                return redirect(url('dashboard'));
            }

        }
        return redirect(route('login'))->with("FlashMessage","Username Atau Password Salah!");
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('login'))->with("FlashSukses","Berhasil Logout !");
    }
}

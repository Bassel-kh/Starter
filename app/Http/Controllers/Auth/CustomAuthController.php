<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CustomAuthController extends Controller
{
    public function  adminLogin(){
        return view('auth.adminLogin');
    }

    public function  checkAdminLogin(Request $request){
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if(Auth::guard('admin')->attempt($request->only('email','password'))){
            return redirect() ->intended(route('admin'));
        }
        return back()->withInput($request->only('email'));

    }


    public function adult(){
        return view('customAuth.index');
    }

    public function site(){
        return view('site');
    }

    public function admin(){
        return view('admin');
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;


class CustomAuthController extends Controller
{
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

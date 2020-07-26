<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function redirect($service)
    {
        return Socialite::driver($service)->redirect();
    }

//    public function callback($service)
//    {
////        return $user = Socialite::with($service)-> user() ;
//////        return view('welcome');
//    }

    public function callback($service,Request $request)
    {
        $user = Socialite::driver($service) ->stateless()-> user() ;
        return response() -> json($user);
    }
}

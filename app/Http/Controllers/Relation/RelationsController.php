<?php

namespace App\Http\Controllers\Relation;

use App\Http\Controllers\Controller;
use App\Models\phone;
use Illuminate\Http\Request;

class RelationsController extends Controller
{
    public function hasOneRelation(){
//        $user =\App\User::find(5); //or \App\User::where('id',15)->first();
//        return $user -> phone;
//        $phone = user -> phone; // error

//        $user =\App\User::with('phone')->find(5);
            $user =\App\User::with(['phone' =>function($q){
                    $q ->select('code', 'phone','user_id');
                }])->find(5);


        return response() ->json($user);
    }
}

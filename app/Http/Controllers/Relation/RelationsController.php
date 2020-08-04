<?php

namespace App\Http\Controllers\Relation;

use App\Http\Controllers\Controller;
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

//            return $user -> phone -> code;

        return response() ->json($user);
    }

    public function hasOneRelationReverse(){
         $phone = \App\Models\Phone::find(0);

        // Make some attribute Visible
        $phone ->makeVisible(['user_id']);
        // $phone ->makeHidden(['code']);
        // return $phone -> user; // return user of this phone number
        // get all data phone + user
        $phone = \App\Models\Phone::with('user')-> find(0);


        // get custom data phone + user
        $phone =\App\Models\Phone::with(['user' =>function($q){
            $q ->select('email', 'name','id');
        }])->find(0);
        return $phone;

    }

    public function getUserHasPhone(){
        $user = \App\User::whereHas('phone') -> get();
        return $user;
    }

    public function getUserNotHasPhone(){
        return \App\User::whereDoesntHave('phone') -> get();

    }

    public function getUserWhereHasPhoneWithCondition(){

        $user = \App\User::whereHas('phone', function ($q){
            $q -> where('code','963');
        }) -> get();

        return $user;
    }
}

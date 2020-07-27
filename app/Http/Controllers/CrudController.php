<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CrudController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getOffer()
    {
//        return Offer::get();
        return Offer::select('id','name') -> get();
    }

//    public function  store(){
//        //insert data to Offer table
//        Offer::create([
//            'name' => 'Offer3',
//            'price' => '50000',
//            'details' => 'offer details',
//
//        ]);
//
//    }

    public function  create(){
            return view('offers.create');
    }

    public function  store(Request $request){

        // validate data before insert to database
        // make para: array , validation roles, message
        $roles = $this -> getRoles();

        $messages = $this -> getMessages();
        $validator = Validator::make($request -> all(),$roles, $messages);

        if($validator -> fails()){
            return  $validator -> errors();
        }
        //insert
        Offer::create([
            'name'=> $request -> name,
            'price'=> $request -> price,
            'details'=> $request -> details,
        ]);

        return 'Save successfully';
    }

    protected function  getRoles(){
        return [
            'name' => 'required|max:100|unique:offers,name',
            'price' => 'required|numeric',
            'details' => 'required',
        ];
    }


    protected  function  getMessages(){
        return [
            'name.required' => 'اسم العرض مطلوب',
            'name.unique' => 'اسم العرض مكرر',
            'price.required' => 'سعر العرض يجب أن يكون أرقام',
            'details.required' => 'تفاصيل العرض مطلوب',
        ];
    }

}

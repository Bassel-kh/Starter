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
//            return  $validator -> errors();
            return  redirect() ->back() -> withErrors($validator) ->withInputs($request -> all());
        }
        //insert
        Offer::create([
            'name'=> $request -> name,
            'price'=> $request -> price,
            'details'=> $request -> details,
        ]);

//        return 'Save successfully';
        return redirect() -> back() -> with(['success' => 'تم إضافة العرض بنجاح']);

    }

    protected function  getRoles(){
        return [
            'name' => 'required|max:100|unique:offers,name',
            'price' => 'required|numeric',
            'details' => 'required',
        ];
    }


    protected  function  getMessages(){
//        return [
//            'name.required' => 'اسم العرض مطلوب',
//            'name.unique' => 'اسم العرض مكرر',
//            'price.numeric' => 'سعر العرض يجب أن يكون أرقام',
//            'price.required' => 'سعر العرض مطلوب',
//            'details.required' => 'تفاصيل العرض مطلوب',
//        ];

        return [
            'name.required' => trans('messages.offer name required'),
            'name.unique' =>__('messages.offer name must be unique'),
            'price.numeric' => __('messages.Offer price Must be numeric'),
            'price.required' => 'سعر العرض مطلوب',
            'details.required' => 'تفاصيل العرض مطلوب',
        ];
    }

}

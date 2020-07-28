<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use LaravelLocalization;

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

    public function  store(OfferRequest $request){
//
//        // validate data before insert to database
//        // make para: array , validation roles, message
//        $roles = $this -> getRoles();
//
//        $messages = $this -> getMessages();
//        $validator = Validator::make($request -> all(),$roles, $messages);
//
//        if($validator -> fails()){
////            return  $validator -> errors();
//            return  redirect() ->back() -> withErrors($validator) ->withInputs($request -> all());
//        }
        //insert
        Offer::create([
            'name_ar'=> $request -> name_ar,
            'name_en'=> $request -> name_en,
            'price'=> $request -> price,
            'details_ar'=> $request -> details_ar,
            'details_en'=> $request -> details_en,

        ]);

//        return 'Save successfully';
        return redirect() -> back() -> with(['success' => 'تم إضافة العرض بنجاح']);

    }

    /**
     * editOffer
     */
    public function editOffer($offer_id){
//        Offer::findOrFail($offer_id);
        $offer = Offer::find($offer_id); // search in given table by Id only

        if(!$offer){
            return redirect() -> back();
        }
        $offer = Offer::select('id', 'name_ar', 'name_en', 'price', 'details_ar', 'details_en') -> find($offer_id);
        return  view('offers.edit', compact('offer'));

    }

    /**
     * updateOffer
     */
    public function updateOffer(OfferRequest $request){
        // validation request

        // update Data

    }

//    protected function  getRoles(){
//        return [
//            'name' => 'required|max:100|unique:offers,name',
//            'price' => 'required|numeric',
//            'details' => 'required',
//        ];
//    }


//    protected  function  getMessages(){
//        return [
//            'name.required' => trans('messages.offer name required'),
//            'name.unique' =>__('messages.offer name must be unique'),
//            'price.numeric' => __('messages.Offer price Must be numeric'),
//            'price.required' => __('messages.offer price required'),
//            'details.required' => 'تفاصيل العرض مطلوب',
//        ];
//    }

    protected function getAllOffers(){
         $offers = Offer::select('id', 'price', 'name_' . LaravelLocalization::getCurrentLocale() . ' as name',
             'details_' . LaravelLocalization::getCurrentLocale() . ' as details') -> get(); // return collection
         return view('offers.all', compact('offers'));
    }

}

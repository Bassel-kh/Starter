<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\Traits\OfferTrait;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class OfferController extends Controller
{
    use OfferTrait;
    public function create(){
        // view form to add this offer
        return view('ajaxoffers.create');
    }

    /**
     *   Methode store
     */
    // this method without validation
    public function store(OfferRequest $request){
        // save offer into DB using AJAX
        // save photo in folder
        $file_name = $this -> saveImage( $request -> photo ,'images/offers');


        //insert to offer table in dataBase
        $offer = Offer::create([
            'photo'=> $file_name,
            'name_ar'=> $request -> name_ar,
            'name_en'=> $request -> name_en,
            'price'=> $request -> price,
            'details_ar'=> $request -> details_ar,
            'details_en'=> $request -> details_en,

        ]);
        if($offer){
            return response() -> json([
                'status'=> true,
                'msg'=> 'تم الحفظ بنجاح',
            ]);
        }
        else{
            return response() -> json([
                'status'=> false,
                'msg'=> 'فشل الحفظ الرجاء المحاولة محدداً',
            ]);
        }

    }

    /**
     *   Methode all
     */
    public function  all(){
         $offers = Offer::select(
            'id',
            'price',
            'photo',
            'name_' . LaravelLocalization::getCurrentLocale() . ' as name',
            'details_' . LaravelLocalization::getCurrentLocale() . ' as details'
        ) ->limit(10)-> get(); // return collection
        return view('ajaxoffers.all', compact('offers'));

    }
    /**
     *   Methode Delete
     */
    public function  delete(Request $request){
        $offer = Offer::find($request -> id);   // Offer::where('id','$offer_id') -> first();

        if (!$offer)
            return redirect()->back()->with(['error' => __('messages.offer not exist')]);

        $offer->delete();

        return response()->json([
            'status' => true,
            'msg' => 'تم الحذف بنجاح',
            'id' =>  $request -> id
        ]);

    }

    /**
     * Method edit
     */
    public function edit(Request $request)
    {
//        Offer::findOrFail($offer_id);
        $offer = Offer::find($request->offer_id); // search in given table by Id only

        if (!$offer) {
            return response()->json([
                'status' => false,
                'msg' => 'هذا العرض غير موجود',
            ]);
        }
        $offer = Offer::select('id', 'name_ar', 'name_en', 'price', 'photo', 'details_ar', 'details_en')->find($request->offer_id);
            return  view('ajaxoffers.edit', compact('offer'));

    }

    /**
     * updateOffer
     */
//    public function update(OfferRequest $request, $offer_id){
    public function update(Request $request){
        // validation request

        // check if Offer exists
        $offer = Offer::find($request -> offer_id);
        if(!$offer) {
            return response()->json([
                'status' => false,
                'msg' => 'هذا العرض غير موجود',
            ]);
        }

        // update Data
        $offer -> update($request ->all());
        return response() -> json([
            'status'=> true,
            'msg'=> 'تم التحديث بنجاح',
        ]);
    }

}

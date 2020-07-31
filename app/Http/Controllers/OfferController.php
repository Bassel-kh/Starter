<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\Traits\OfferTrait;
use Illuminate\Http\Request;
class OfferController extends Controller
{
    use OfferTrait;
    public function create(){
        // view form to add this offer
        return view('ajaxoffers.create');
    }

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
}

<?php

namespace App\Http\Controllers;

use App\Events\VideoViewer;
use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\Models\Video;
use App\Traits\OfferTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use LaravelLocalization;


class CrudController extends Controller
{
    use OfferTrait;
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

        // save photo in folder
        $file_name = $this -> saveImage( $request -> photo ,'images/offers');


        //insert
        Offer::create([
            'photo'=> $file_name,
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
    public function updateOffer(OfferRequest $request, $offer_id){
        // validation request

        // check if Offer exists
        $offer = Offer::find($offer_id);
        if(!$offer)
            return redirect() -> back();

        // update Data
        $offer -> update($request ->all());
        // or
//        $offer -> update([
//                'name_ar' => $request -> name_ar,'name_en' => $request -> name_ar,
//                'price' => $request -> price, 'details_ar' => $request -> details_ar,
//                'details_en' => $request -> details_en,
//        ]);
            return  redirect() -> back() ->with(['success' => 'تم التحديث بنجاح']);
    }

    public function  deleteOffer($offer_id){
        // check if Offer exists
        $offer = Offer::find($offer_id); // Offer::where('id','','$offer_id') -> first();
        if(!$offer)
            return redirect() -> back() -> with(['error' => __('messages.offer not exist')]);

        // delete Data
        $offer -> delete();

//        return  redirect() -> back() ->with(['success' => __('messages.offer deleted successfully')]);
        return  redirect() -> route('offers.all',$offer_id) ->with(['success' => __('messages.offer deleted successfully')]);

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
            'details_' . LaravelLocalization::getCurrentLocale() . ' as details', 'photo') -> get(); // return collection
        return view('offers.all', compact('offers'));
    }

    public function getVideo(){
        $video = Video::first();

        event(new VideoViewer($video));
        return view('video') ->with('video',$video);
    }

//    /////////////////////// Functions ///////////////////////////////////
//    protected function saveImage($photo, $folder){
//
//        //$file_extension = $request -> photo -> getClientOriginalExtension();
//        $file_original_name =  $photo -> getClientOriginalName();
//        $file_name = time().$file_original_name;
//        $path = $folder;
//        $photo -> move($path, $file_name);
//
//        return $file_name;
//    }

}

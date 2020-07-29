<?php
namespace App\Traits;

Trait OfferTrait {
    /////////////////////// Functions ///////////////////////////////////
    function saveImage($photo, $folder){

        //$file_extension = $request -> photo -> getClientOriginalExtension();
        $file_original_name =  $photo -> getClientOriginalName();
        $file_name = time().$file_original_name;
        $path = $folder;
        $photo -> move($path, $file_name);

        return $file_name;
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
//        return false;
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:100|unique:offers,name',
            'price' => 'required|numeric',
            'details' => 'required',
        ];
    }

        public function messages(){
        return [
            'name.required' => trans('messages.offer name required'),
            'name.unique' =>__('messages.offer name must be unique'),
            'price.numeric' => __('messages.Offer price Must be numeric'),
            'price.required' => __('messages.offer price required'),
            'details.required' => __('messages.Offer details required'),
        ];
    }
}

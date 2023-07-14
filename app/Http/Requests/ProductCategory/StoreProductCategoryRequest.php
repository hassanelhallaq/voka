<?php

namespace App\Http\Requests\ProductCategory;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

use Auth;

class StoreProductCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {
        $data = $request->except(array('_token'));
        $validator = Validator::make($data, $this->rules(), $this->messages());
        return Redirect::back()->with('locale', app()->getLocale())
            ->withErrors($validator)
            ->withInput();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_name' => 'required|string',
            'category_name_english' => 'required|string',
            'category_order' => 'required',
            'category_status' => 'required',
        ];
    }

    public function messages()
    {

        if (app()->getLocale() == "en") {
            return [
                'category_name.required' => 'Please Enter Category Name In Arabic',
                'category_name_english.required' => 'Please Enter Category Name In English',
                'category_order.required' => 'Please Enter Category Order',
                'category_status.required' => 'Please Select Category Status',
            ];
        } elseif (app()->getLocale() == "ar") {
            return [
                'category_name.required' => 'Please Enter Category Name In Arabic',
                'category_name_english.required' => 'Please Enter Category Name In English',
                'category_order.required' => 'Please Enter Category Order',
                'category_status.required' => 'Please Select Category Status',
            ];
        }
    }
}

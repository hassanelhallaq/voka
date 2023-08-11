<?php

namespace App\Http\Requests\product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

use Auth;

class StoreProductRequest extends FormRequest
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
            'name' => 'required|string',
            'name_english' => 'required|string',
            'desc_arabic' => 'required',
            'desc_english' => 'required',
            'price' => 'required',
            'calories' => 'required',
            'quantity_stock' => 'required',
            'department_id' => 'required',
        ];
    }

    public function messages()
    {

        if (app()->getLocale() == "en") {
            return [
                'name.required' => 'Please Enter  Name In Arabic',
                'name_english.required' => 'Please Enter  Name In English',
                'desc_arabic.required' => 'Please Enter  desc',
                'desc_english.required' => 'Please Enter desc In English',
                'calories.required' => 'Please Enter calories ',
                'quantity_stock.required' => 'Please Enter quantity stock ',

            ];
        } elseif (app()->getLocale() == "ar") {
            return [
                'name.required' => 'يرجى إدخال الاسم بالعربية',
                'name_english.required' => 'يرجى إدخال الاسم بالإنجليزية',
                'desc_arabic.required' => 'يرجى إدخال الوصف',
                'desc_english.required' => 'يرجى إدخال الوصف بالإنجليزية',
                'price.required' => 'يرجى إدخال السعر',
                'calories.required' => 'يرجى إدخال السعرات الحرارية',
                'quantity_stock.required' => 'يرجى إدخال الكمية',

            ];
        }
    }
}

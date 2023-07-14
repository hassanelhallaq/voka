<?php

namespace App\Http\Requests\lounge;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

use Auth;

class StoreloungeRequest extends FormRequest
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

            'name' => 'required',
            'name_en' => 'required',

        ];
    }

    public function messages()
    {

        if (app()->getLocale() == "en") {
            return [
                'name.required' => 'Please Enter  Name In Arabic',
                'name_en.required' => 'Please Enter  Name In English',
                'phone.required' => 'Please Enter phone',
                'phone.unique' => 'Please Enter unique phone ',
                'manger.required' => 'Please Enter manger name ',

            ];
        } elseif (app()->getLocale() == "ar") {
            return [
                'name.required' => 'الرجاء إدخال الاسم بالعربية',
                'name_en.required' => 'الرجاء إدخال الاسم بالانجليزية',
                'email.unique' => 'الرجاء ادخال اميل غير مسجل مسبقا',
                'phone.unique' => 'الرجاء ادخال رقم هاتف غير مسجل مسبقا',
                'phone.required' => 'الرجاء ادخال رقم الهاتف',
                'manger.required' => 'الرجاء ادخال اسم المدير',

            ];
        }
    }
}

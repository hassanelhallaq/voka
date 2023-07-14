<?php

namespace App\Http\Requests\table;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

use Auth;

class StoreTableRequest extends FormRequest
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

        ];
    }

    public function messages()
    {

        if (app()->getLocale() == "en") {
            return [
                'name.required' => 'Please Enter  Name In Arabic',
                'count_tables.required' => 'Please Enter  Name In English',

            ];
        } elseif (app()->getLocale() == "ar") {
            return [
                'name.required' => 'الرجاء إدخال الاسم ',


            ];
        }
    }
}

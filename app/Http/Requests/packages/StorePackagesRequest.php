<?php

namespace App\Http\Requests\packages;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;


class StorePackagesRequest extends FormRequest
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
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($validator->failed()) {
                $validator->errors()->add('field', 'Something is wrong with this field!'); // handle your new error message here
            }
        });
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'day_of_week.*' => [
                'required',
                Rule::in(['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday']),
            ],
            'start_time.*' => 'required|date_format:H:i',
            'end_time.*' => 'required|date_format:H:i|after:start_time.*',
            'name' => 'required|string',
            'name_en' => 'required|string',
            'price' => 'required|integer',
            'discount' => 'required|integer',
            'time' => 'required',
            'branch_id' => 'required|exists:branches,id',
            'table_id.*' => 'required|exists:tables,id',
        ];
    }

    public function messages()
    {

        if (app()->getLocale() == "en") {
            return [
                'required' => 'The :attribute field is required.',
                'string' => 'The :attribute field must be a string.',
                'in' => 'The selected :attribute is invalid.',
                'integer' => 'The :attribute field must be an integer.',
                'boolean' => 'The :attribute field must be either true or false.',
                'date' => 'The :attribute is not a valid date.',
                'exists' => 'The selected :attribute is invalid.',

            ];
        } elseif (app()->getLocale() == "ar") {
            return [
                'required' => 'حقل :attribute مطلوب.',
                'string' => 'حقل :attribute يجب أن يكون نصًا.',
                'integer' => 'حقل :attribute يجب أن يكون رقمًا صحيحًا.',
                'date_format' => 'حقل :attribute يجب أن يكون بتنسيق :format.',
                'after' => 'حقل :attribute يجب أن يكون بعد الحقل :other.',
                'in' => 'حقل :attribute يجب أن يكون أحد الخيارات التالية: :values.',
                'exists' => 'حقل :attribute غير صحيح.',
            ];
        }
    }
}

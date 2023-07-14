<?php

namespace App\Http\Requests\coupons;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

use Auth;

class StoreCouponsRequest extends FormRequest
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
            'code' => 'required|string',
            'coupon_type' => 'required|in:percent,value',
            'coupon_discount' => 'required|integer',
            'count_use' => 'required|integer',
            'customer_use' => 'required|integer',
            'from' => 'required|date',
            'to' => 'required|date',
            'branch_id' => 'required|exists:branches,id',
            'product_id' => 'required|exists:products,product_id',
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
                'string' => 'حقل :attribute يجب أن يكون نصاً.',
                'in' => 'قيمة :attribute المحددة غير صالحة.',
                'integer' => 'حقل :attribute يجب أن يكون عدداً صحيحاً.',
                'boolean' => 'حقل :attribute يجب أن يكون إما صحيحاً أو خاطئاً.',
                'date' => 'القيمة :attribute غير تاريخ صحيح.',
                'exists' => 'القيمة المحددة في حقل :attribute غير صالحة.',
            ];
        }
    }
}

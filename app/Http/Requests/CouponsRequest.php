<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [];
        $currentAction = $this->route()->getActionMethod();
        switch ($this->method()):
            case 'POST':
                switch ($currentAction):
                    case 'postCoupon':
                        $rules = [
                            'title' => 'required',
                            'code_discount' => 'required',
                            'discount' => 'required|integer|min:0|max:100',
                        ];
                        break;
                endswitch;
                break;
        endswitch;
        // dd($currentAction);

        return $rules;
    }

    public function attributes()
    {
        return [
            'title' => 'Tiêu đề',
            'code_discount' => 'Mã giảm giá',
            'discount' => 'Giảm giá',
        ];
    }


    public function messages()
    {
        return [
            'title.required' => ':attribute không được bỏ trống',
            'code_discount.required' => ':attribute không được bỏ trống',
            'discount.required' => ':attribute không được bỏ trống',
            'discount.integer' => ':attribute phải là số',
            'discount.min' => ':attribute phải lớn hơn :min',
            'discount.max' => ':attribute phải nhỏ hơn :max',

        ];
    }
}

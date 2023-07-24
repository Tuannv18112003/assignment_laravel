<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class ProductsRequest extends FormRequest
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
        $id = session('id');
        $currentAction = $this->route()->getActionMethod();
        switch ($this->method()):
            case 'POST':
                switch ($currentAction):
                    case 'postProducts':
                    case 'editProducts':
                        // Xây dựng rules trong này
                        $rules = [
                            'product_name' => 'required',
                            'color' => 'required',
                            'config' => 'required',
                            'price' => 'required|integer|min:0',
                            'sale' => 'nullable|integer|min:0|max:100',
                            'brand_id' => 'required',
                        ];
                        break;
                    case 'postProducts': 
                        $rule = [
                            'image' => 'required|image|mimes:jpeg,jpg,png|max:5120', // 5120kb <=> 5mb
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
            'product_name' => 'Tên sản phẩm',
            'image' => 'Hình ảnh',
            'color' => 'Màu sắc',
            'config' => 'Cấu hình',
            'price' => 'Giá',
            'sale' => 'Giảm giá',
            'brand_id' => 'Thương hiệu'
        ];
    }


    public function messages()
    {
        return [
            'product_name.required' => ':attribute không được bỏ trống',
            'image.required' => ':attribute không được bỏ trống',
            'color.required' => ':attribute không được bỏ trống',
            'config.required' => ':attribute không được bỏ trống',
            'price.required' => ':attribute không được bỏ trống',
            'price.integer' => ':attribute phải là số',
            'price.min' => ':attribute phải lớn hơn :min',
            // 'sale.required' => ':attribute không được bỏ trống',
            'sale.integer' => ':attribute phải là số',
            'sale.min' => ':attribute phải lớn hơn :min',
            'sale.max' => ':attribute phải nhỏ hơn :max',
            'brand_id.required' => ':attribute không được bỏ trống',

        ];
    }
}

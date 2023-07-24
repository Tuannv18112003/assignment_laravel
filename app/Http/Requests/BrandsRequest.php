<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BrandsRequest extends FormRequest
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
                    case 'postBrands':
                    // case 'editProducts':
                        // Xây dựng rules trong này
                        $rules = [
                            'brand_name' => 'required',
                            'description' => 'nullable|max:300',
                            'image' => 'nullable|image|mimes:jpeg,jpg,png|max:5120', // 5120kb <=> 5mb
                        ];
                        break;
                    // case 'postBrands':
                    //     $rule = [
                    //     ];
                    //     break;
                endswitch;
                break;
        endswitch;
        // dd($currentAction);

        return $rules;
    }

    public function attributes()
    {
        return [
            'brand_name' => 'Tên sản phẩm',
            'description' => 'Mô tả',
            'image' => 'Hình ảnh'
        ];
    }


    public function messages()
    {
        return [
            'brand_name.required' => ':attribute không được bỏ trống',
            'description.max' => ':attribute không vượt quá :max kí tự',

        ];
    }
}

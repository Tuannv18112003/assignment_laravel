<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SlidesRequest extends FormRequest
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
                    case 'postSlides':
                        // Xây dựng rules trong này
                        $rules = [
                            'title' => 'required',
                            'description' => 'nullable|max:300',
                            'image' => 'required|image|mimes:jpeg,jpg,png|max:5120', // 5120kb <=> 5mb

                        ];
                        break;
                        
                    case 'updateSlides':
                        $rules = [
                            'title' => 'required',
                            'description' => 'nullable|max:300',
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
            'title' => 'Tiêu đề slide',
            'description' => 'Mô tả',
            'image' => 'Hình ảnh'
        ];
    }


    public function messages()
    {
        return [
            'title.required' => ':attribute không được bỏ trống',
            'description.max' => ':attribute không vượt quá :max kí tự',
            'image.required' => ':attribute không được bỏ trống',
            'image.image' => ':attribute phải là hình ảnh',
            'image.max' => ':attribute không vượt quá 5MB',

        ];
    }
}

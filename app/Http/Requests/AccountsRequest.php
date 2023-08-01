<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AccountsRequest extends FormRequest
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
                    case 'postAccounts':
                    // case 'editProducts':
                        // Xây dựng rules trong này
                        $rules = [
                            'name' => 'required',
                            'email' => 'required|email|unique:users',
                            'image' => 'nullable|image|mimes:jpeg,jpg,png|max:5120', // 5120kb <=> 5mb
                            'password' => 'required',
                            'rule' => 'required',
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
            'name' => 'Tên tài khoản',
            'email' => 'Email',
            'image' => 'Hình ảnh',
            'password' => 'Mật khẩu',
            'rule' => 'Vai trò'
        ];
    }


    public function messages()
    {
        return [
            'name.required' => ':attribute không được bỏ trống',
            'email.required' => ':attribute không được bỏ trống',
            'email.email' => 'Phải là :attribute',
            'email.unique' => ':attribute đã tồn tại',
            'image.image' => ':attribute phải là ảnh',
            'image.mimes' => ':attribute đuôi file không đúng',
            'image.max' => ':attribute phải nhỏ hơn :max',
            'password.required' => ':attribute không được bỏ trống',
            'rule.required' => ':attribute không được bỏ trống'

        ];
    }
}

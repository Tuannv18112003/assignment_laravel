<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientsRequest extends FormRequest
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
                    case 'addOrdersCarts':
                    // case 'editProducts':
                        $rules = [
                            'username' => 'required',
                            'email' => 'required',
                            'phone' => ['required', 'regex:/^(0|\+84)\d{9}$/'],
                            'address' => 'required',
                            'rePassword' => 'same:password',
                        ];
                        break;
                    // case 'postProducts':
                    //     $rule = [
                    //         'image' => 'required|image|mimes:jpeg,jpg,png|max:5120', // 5120kb <=> 5mb
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
            'username' => 'Tên khách hàng',
            'email' => 'email',
            'phone' => 'Số điện thoại',
            'address' => 'Địa chỉ',
            'password' => 'Mật khẩu',
            'rePassword' => 'Nhập lại mật khẩu'
        ];
    }


    public function messages()
    {
        return [
            'username.required' => ':attribute không được bỏ trống',
            'email.required' => ':attribute không được bỏ trống',
            // 'email.unique' => ':attribute đã tồn tại',
            'phone.required' => ':attribute không được bỏ trống',
            'phone.regex' => ':attribute không hợp lệ',
            'address.required' => ':attribute không được bỏ trống',
            'rePassword.same' => ':attribute không trùng khớp',

        ];
    }
}

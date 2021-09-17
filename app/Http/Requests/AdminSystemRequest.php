<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminSystemRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:100',
            'email' => 'required|max:100|email|unique:users,email',
            'password' => 'required|min:8|max:30|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên không được phép để trống',
            'name.max' => 'Tên phải ít hơn 100 ký tự',
            'email.required' => 'Email không được phép để trống',
            'email.max' => 'Email phải ít hơn 100 ký tự',
            'email.unique' => 'Email đã tồn tại',
            'email.email' => 'Yêu cầu nhập đúng đinh dạng email',
            'password.required' => 'Password không được phép để trống',
            'password.min' => 'Password tối thiểu 8 ký tự',
            'password.max' => 'Password tối thiểu 30 ký tự',
            'password.confirmed' => 'Vui lòng nhập lại đúng mật khẩu',
        ];
    }
}

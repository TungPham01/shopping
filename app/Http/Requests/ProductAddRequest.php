<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductAddRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true ;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:products|max:255|min:10',
            'price' => 'required|numeric',
            'category_id' => 'required',
            'contents' => 'required',

        ];
    }

    public function messages() {
        return [
            'name.required' => 'Tên không được phép để trống',
            'name.unique' => 'Tên đã tồn tại',
            'name.max' => 'Tên phải ít hơn 255 ký tự',
            'name.min' => 'Tên phải nhiều hơn 10 ký tự',
            'price.required' => 'Gía tiền không được để trống',
            'price.numeric' => 'Gía tiền phải là một số',
            'category_id' => 'Danh mục không được phép để trống',
            'contents' => 'Nội dụng không được phép để trống',

        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderAddRequest extends FormRequest
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
            'name' => 'required|unique:sliders|max:255',
            'description' => 'required',
            'image_path' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Trường tên là bắt buộc',
            'name.unique' => 'Tên đã tồn tại',
            'name.max' => 'Tên tối đa 255 ký tự',
            'description.required' => 'Trường mô tả là bắt buộc',
            'image_path.required' => 'Trường upload là bắt buộc'
        ];
    }
}

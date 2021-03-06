<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingRequest extends FormRequest
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
            // id là id từ url
            'config_key' => ['required','max:256','unique:settings,config_key,'.$this->id.',id,deleted_at,NULL'],
            'config_value' => 'required'
        ];
    }
}

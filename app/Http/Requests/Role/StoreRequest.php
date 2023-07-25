<?php

namespace App\Http\Requests\Role;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
    public function attributes()
    {
        $lang = "role_lang";
        return [
            'name' => __("$lang.attributes.name"),
        ];
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:roles',
        ];
    }
}

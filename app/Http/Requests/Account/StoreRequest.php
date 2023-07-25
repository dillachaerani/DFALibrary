<?php

namespace App\Http\Requests\Account;

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
        $lang = "account_lang";
        return [
            'name'     => __("$lang.attributes.name"),
            'username' => __("$lang.attributes.username"),
            'email'    => __("$lang.attributes.email"),
            'password' => __("$lang.attributes.password"),
        ];
    }

    public function rules()
    {
        return [
            'name'     => 'required|string|max:255',
            'username' => 'required|string|min:6|max:15|unique:users',
            'email'    => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ];
    }
}

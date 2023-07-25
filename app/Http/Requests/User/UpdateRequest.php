<?php

namespace App\Http\Requests\User;

class UpdateRequest extends StoreRequest
{
    public function rules()
    {
        $rules = parent::rules();
        if (empty(request()->password)) {
            unset($rules['password']);
        }
        $rules['username'] = 'required|string|min:6|max:30|unique:users,username,' . decrypt($this->route('user'));
        $rules['email'] = 'required|email|max:255|unique:users,email,' . decrypt($this->route('user'));
        return $rules;
    }
}

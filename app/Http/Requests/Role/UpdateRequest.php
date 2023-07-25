<?php

namespace App\Http\Requests\Role;

class UpdateRequest extends StoreRequest
{
    public function rules()
    {
        $rules = parent::rules();
        $rules['name'] = 'required|string|max:255|unique:roles,name,' . decrypt($this->route('role'));
        return $rules;
    }
}

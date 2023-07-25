<?php

namespace App\Http\Requests\Permission;

class UpdateRequest extends StoreRequest
{
    public function rules()
    {
        $rules = parent::rules();
        $rules['name'] = 'required|string|max:255|unique:permissions,name,' . decrypt($this->route('permission'));
        return $rules;
    }
}

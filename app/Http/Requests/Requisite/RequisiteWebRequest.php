<?php

namespace App\Http\Requests\Requisite;

use Illuminate\Foundation\Http\FormRequest;

class RequisiteWebRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:255', 'unique:requisites,name'],
            'inn' => ['required', 'string', 'min:3', 'max:255'],
            'bik' => ['required', 'string', 'min:3', 'max:255'],
            'account' => ['required', 'string', 'min:3', 'max:255'],
        ];
    }
}

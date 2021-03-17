<?php

namespace App\Http\Requests\Applications;

use Illuminate\Foundation\Http\FormRequest;

class ApplicationWebRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['nullable', 'string', 'min:3', 'max:255'],
            'phone' => ['required', 'string', 'min:3', 'max:255'],
            'date' => ['nullable', 'date', 'after_or_equal:today'],
        ];
    }
}
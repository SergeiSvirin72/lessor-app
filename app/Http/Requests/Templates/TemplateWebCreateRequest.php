<?php

namespace App\Http\Requests\Templates;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class TemplateWebCreateRequest extends TemplateWebRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            'name' => [
                'required', 'string', 'min:1', 'max:255',
                Rule::unique('templates')->where(function ($query) {
                    return $query->where('team_id', Auth::user()->team_id);
                })
            ],
            'file' => ['required', 'file', 'max:2048']
        ]);
    }
}
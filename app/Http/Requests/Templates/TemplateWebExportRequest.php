<?php

namespace App\Http\Requests\Templates;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class TemplateWebExportRequest extends TemplateWebRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            'template_id' => ['required', Rule::exists('templates', 'id')->where(function ($query) {
                $query->where('team_id', Auth::user()->team_id);
            })],
        ]);
    }
}
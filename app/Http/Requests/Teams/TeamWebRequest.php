<?php

namespace App\Http\Requests\Teams;

use Illuminate\Foundation\Http\FormRequest;

class TeamWebRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'min:1', 'max:255'],
            'alias' => ['required', 'alpha_dash', 'min:1', 'max:255'],
            'document_full_name' => ['required', 'string', 'min:1', 'max:255'],
            'document_short_name' => ['required', 'string', 'min:1', 'max:255'],
            'document_signature' => ['required', 'string', 'min:1', 'max:255']
        ];
    }
}

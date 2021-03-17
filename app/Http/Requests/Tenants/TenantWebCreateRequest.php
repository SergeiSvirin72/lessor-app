<?php

namespace App\Http\Requests\Tenants;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class TenantWebCreateRequest extends TenantWebRequest
{
    public function rules()
    {
        return array_merge(parent::rules(), [
            'inn' => ['required', 'string', 'min:1', 'max:255',
                Rule::unique('tenants', 'inn')->where(function ($query) {
                    return $query->where('team_id', Auth::user()->team_id);
                })
            ],
            'document_full_name' => ['required', 'string', 'min:1', 'max:255'],
            'document_short_name' => ['required', 'string', 'min:1', 'max:255'],
        ]);
    }
}

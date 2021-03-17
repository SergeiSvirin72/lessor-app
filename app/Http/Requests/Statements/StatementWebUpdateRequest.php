<?php

namespace App\Http\Requests\Statements;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StatementWebUpdateRequest extends StatementWebRequest
{
    public function rules()
    {
        return array_merge(parent::rules(), [
            'tenant_id' => ['required', Rule::in(Auth::user()->team->tenants()->pluck('tenants.id'))]
        ]);
    }
}
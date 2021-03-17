<?php

namespace App\Http\Requests\Contracts;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ContractWebRequest extends FormRequest
{
    public function rules()
    {
        return [
            'number' => ['required', 'string', 'min:3', 'max:255'],
            'date_start' => ['required', 'date'],
            'date_end' => ['required', 'date', 'after_or_equal:date_start'],
            'security_payment' => ['nullable', 'integer', 'min:1'],
            'tenants' => ['required', 'array', 'min:1'],
            'tenants.*' => ['required', Rule::exists('tenants', 'id')->where(function ($query) {
                $query->where('team_id', Auth::user()->team_id);
            })],
            'attachments' => ['array'],
            'attachments.*' => ['file', 'max:2048'],
        ];
    }
}

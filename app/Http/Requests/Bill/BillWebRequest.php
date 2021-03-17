<?php

namespace App\Http\Requests\Bill;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class BillWebRequest extends FormRequest
{
    public function rules()
    {
        return [
            'number' => ['required', 'string', 'min:3', 'max:255'],
            'comment' => ['nullable', 'string', 'min:3'],
            'requisite_id' => ['required', Rule::exists('requisites', 'id')->where(function ($query) {
                $query->where('team_id', Auth::user()->team_id);
            })],
            'contract_id' => ['required', Rule::exists('contract_tenant', 'contract_id')->where(function ($query) {
                $query->where('tenant_id', $this->tenant->id);
            })],
            'attachments' => ['array'],
            'attachments.*' => ['file', 'max:2048'],
            'services' => ['required', 'array', 'min:1'],
            'services.*.name' => ['required', 'string', 'min:3', 'max:255'],
            'services.*.quantity' => ['required', 'integer', 'min:1'],
            'services.*.measure' => ['required', 'string', 'min:1', 'max:255'],
            'services.*.price' => ['required', 'numeric', 'min:0.01'],
        ];
    }

//    public function getAttributes(): array
//    {
//        return $this->intersect(array_keys($this->rules()));
//    }
//
//    public function isAttachments()
//    {
//        return (bool)$this->has('attachments');
//    }
//
//    public function getAttachments()
//    {
//        return $this->get('attachments');
//    }

}

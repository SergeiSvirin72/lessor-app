<?php

namespace App\Http\Requests\Balance;

use Illuminate\Foundation\Http\FormRequest;

class BalanceWebRequest extends FormRequest
{
    public function rules()
    {
        return [
            'amount' => ['required', 'integer', 'min:1'],
            'comment' => ['nullable', 'string', 'min:3', 'max:255'],
        ];
    }
}
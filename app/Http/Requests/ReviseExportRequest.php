<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviseExportRequest extends FormRequest
{
    public function rules()
    {
        return [
            'date_start' => ['required', 'date'],
            'date_end' => ['required', 'date', 'after_or_equal:date_start'],
        ];
    }
}
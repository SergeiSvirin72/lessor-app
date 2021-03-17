<?php

namespace App\Http\Requests\Publics;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoomFilterRequest extends FormRequest
{
    public function rules()
    {
        return [
            'status' => ['nullable', Rule::in(['all', 'free', 'not_free']),],
            'floor_id' => ['nullable', Rule::exists('floors', 'id')->where(function ($query) {
                $query->where('estate_id', $this->estate->id);
            })],
        ];
    }
}
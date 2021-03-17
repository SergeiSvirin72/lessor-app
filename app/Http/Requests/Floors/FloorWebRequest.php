<?php

namespace App\Http\Requests\Floors;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FloorWebRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:255',
                Rule::unique('floors', 'name')->where(function ($query) {
                    $query->where('estate_id', $this->estate->id);
                }),
            ],
            'price_square_foot' => ['nullable', 'integer', 'min:1'],
            'img' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ];
    }
}

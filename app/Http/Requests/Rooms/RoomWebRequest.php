<?php

namespace App\Http\Requests\Rooms;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

abstract class RoomWebRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'required', 'string', 'min:1', 'max:255',
                Rule::unique('rooms')->where(function ($query) {
                    return $query->where('floor_id', $this->floor_id);
                })
            ],
            'size' => ['required', 'integer', 'min:1'],
            'price_square_foot' => ['nullable', 'integer', 'min:1'],
            'type' => ['nullable', 'integer', 'min:1'],
            'floor_id' => ['required', Rule::exists('floors', 'id')->where(function ($query) {
                $query->where('estate_id', $this->estate->id);
            })],
            'images' => ['array'],
            'images.*' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'coordinates' => ['nullable', 'json'],
        ];
    }
}

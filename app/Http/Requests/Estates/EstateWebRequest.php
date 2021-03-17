<?php

namespace App\Http\Requests\Estates;

use Illuminate\Foundation\Http\FormRequest;

abstract class EstateWebRequest extends FormRequest
{
    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        if (!$this->get('status')) {
            $this->merge(['status' => false]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:255', 'unique:estates,name'],
            'address' => ['nullable', 'string', 'min:3', 'max:255'],
            'longitude' => ['nullable', 'string', 'min:3', 'max:255'],
            'latitude' => ['nullable', 'string', 'min:3', 'max:255'],
            'price_square_foot' => ['required', 'integer', 'min:1'],
            'mask' => ['required', 'string', 'min:3', 'max:255'],
            'status' => ['boolean'],
            'images' => ['array'],
            'images.*' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ];
    }
}

<?php

namespace App\Http\Requests\Estates;

use Illuminate\Validation\Rule;

class EstateWebUpdateRequest extends EstateWebRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            'name' => [
                'required', 'string', 'max:255',
                Rule::unique('estates', 'name')->ignore($this->route('estate')),
            ]
        ]);
    }
}

<?php

namespace App\Http\Requests\Statements;

class StatementWebCreateRequest extends StatementWebRequest
{
    public function rules()
    {
        return array_merge(parent::rules(), [
            'file' => ['required', 'file', 'mimes:xlsx', 'max:2048']
        ]);
    }
}
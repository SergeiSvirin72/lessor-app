<?php

namespace App\Gateways;

use App\Http\Requests\Templates\TemplateWebCreateRequest;
use App\Models\Template;
use Illuminate\Support\Facades\Auth;

class TemplateGateway
{
    /**
     * Создает этаж и загружает его план.
     *
     * @param TemplateWebCreateRequest $request
     * @return Template
     */
    function create(TemplateWebCreateRequest $request)
    {
        $template = new Template($request->validated());
        $file = $request->file('file');

        $template->fill([
            'path' => $file->store('public/templates'),
            'type' => in_array($file->extension(), ['docx', 'doc']) ? Template::TYPE_WORD : Template::TYPE_HTML,
        ]);

        Auth::user()->team->templates()->save($template);
        return $template;
    }
}
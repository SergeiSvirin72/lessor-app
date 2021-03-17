<?php

namespace App\Exports;

class ExportableDecorator implements Exportable
{
    protected $exportable;

    public function __construct(Exportable $exportable)
    {
        $this->exportable = $exportable;
    }

    public function export($template)
    {
        return $this->exportable->export($template);
    }
}
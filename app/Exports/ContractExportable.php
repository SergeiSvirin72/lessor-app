<?php

namespace App\Exports;

use App\Models\Template;

class ContractExportable extends ExportableDecorator
{
    public function export($template)
    {
        $values = [
            'tenant_short_name' => $this->exportable->tenant->short_name,
            'number' => $this->exportable->number,
            'date_start' => $this->exportable->date_start,
            'date_end' => $this->exportable->date_end
        ];

        $exportable = new TemplatesExport($this->exportable, $template);
        return ($template->type === Template::TYPE_WORD)
            ? $exportable->exportDocx($values) : $exportable->exportPDF($values);
    }
}
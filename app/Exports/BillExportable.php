<?php

namespace App\Exports;

use App\Models\Template;

class BillExportable extends ExportableDecorator
{
    public function export($template)
    {
        $values = [
            'id' => $this->exportable->id,
            'date' => $this->exportable->created_at,
            'team' => $this->exportable->tenant->team->name,
            'tenant' => $this->exportable->tenant->short_name,
            'contract_nubmer' => $this->exportable->contract->number,
            'contract_date' => $this->exportable->contract->date_start,
            'comment' => $this->exportable->comment,
            'price' => $this->exportable->price,

        ];

        $exportable = new TemplatesExport($this->exportable, $template);
        return ($template->type === Template::TYPE_WORD)
            ? $exportable->exportDocx($values) : $exportable->exportPDF($values);
    }
}
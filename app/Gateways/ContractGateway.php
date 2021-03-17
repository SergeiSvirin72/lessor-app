<?php

namespace App\Gateways;

use App\Exports\ContractExportable;
use App\Exports\TemplatesExport;
use App\Http\Requests\Contracts\ContractWebCreateRequest;
use App\Http\Requests\Contracts\ContractWebRequest;
use App\Http\Requests\Templates\TemplateWebExportRequest;
use App\Models\Attachment;
use App\Models\Contract;
use App\Models\Template;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ContractGateway
{
    /**
     * Создает договор и загружает приложения к нему.
     *
     * @param ContractWebCreateRequest $request
     * @return Contract
     */
    public function create(ContractWebCreateRequest $request)
    {
//        if (!$request->has('number')) {
//            $resolver = new MaskResolver();
//            $number = $resolver->resolve();
//        }
        return DB::transaction(function() use ($request) {
            $contract = new Contract($request->validated());
            $contract->save();
            $contract->tenants()->sync($request->tenants);
            $this->attach($request, $contract);
            return $contract;
        });
    }

    /**
     * Загружает приложения к договору.
     *
     * @param ContractWebRequest $request
     * @param Contract $contract
     */
    public function attach(ContractWebRequest $request, Contract $contract)
    {
        if ($request->has('attachments')) {
            $attachmentGateway = app(AttachmentGateway::class);
            $attachments = $attachmentGateway->createAll($request->attachments, 'public/contracts');
            $contract->attachments()->saveMany($attachments);
        }
    }

    public function export(TemplateWebExportRequest $request, Contract $contract) {
        $template = Template::find($request->template_id);
        $contractExportable = new ContractExportable($contract);
        $attachment = $contractExportable->export($template);

        $attachment = new Attachment([ 'path' => Contract::STORAGE_PATH.$attachment ]);
        $contract->attachments()->save($attachment);
        return $attachment;

//        $template = Template::find($request->template_id);
//        $template_path = storage_path('app/'.$template->path);
//
//        $document_name = $contract->getTable().'_'.$contract->id.'_'.$template->id;
//        $document_path = storage_path('app/'.Contract::STORAGE_PATH);
//
//        $values = [
//            'tenant_short_name' => $contract->tenant->short_name,
//            'number' => $contract->number,
//            'date_start' => $contract->date_start,
//            'date_end' => $contract->date_end
//        ];
//
//        $exportable = new TemplatesExport();
//        $attachment = ($template->type === Template::TYPE_WORD)
//            ? $exportable->exportDocx($document_path, $document_name, $template_path, $values)
//            : $exportable->exportPDF($document_path, $document_name, $template_path, $values);
//
//        $attachment = new Attachment([ 'path' => Contract::STORAGE_PATH.$attachment ]);
//        $contract->attachments()->save($attachment);
//        return $attachment;
    }
}

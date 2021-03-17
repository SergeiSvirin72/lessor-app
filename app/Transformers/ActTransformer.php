<?php

namespace App\Transformers;

use App\Models\Bill;
use League\Fractal\TransformerAbstract;

class ActTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'requisite', 'contract', 'attachments'
    ];

    /**
     * Turn this item object into a generic array
     *
     * @param Bill $act
     * @return array
     */
    public function transform(Bill $act)
    {
        return [
            'id' => $act->id,
            'contract_id' => $act->contract_id,
            'price' => $act->price,
            'comment' => $act->comment,
            'requisite_id' => $act->requisite_id,
            'status' => $act->status,
        ];
    }

    public function includeRequisite(Bill $act)
    {
        $requisite = $act->requisite;
        return $requisite ? $this->item($requisite, new RequisiteTransformer) : null;
    }

    public function includeContract(Bill $act)
    {
        $contract = $act->contract;
        return $this->item($contract, new ContractTransformer);
    }

    public function includeAttachments(Bill $act)
    {
        $attachments = $act->attachments;
        return $this->collection($attachments, new AttachmentTransformer);
    }
}

<?php

namespace App\Transformers;

use App\Models\Contract;
use League\Fractal\TransformerAbstract;

class ContractTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'tenant', 'bills', 'attachments', 'contractRooms'
    ];

    /**
     * Turn this item object into a generic array
     *
     * @param Contract $contract
     * @return array
     */
    public function transform(Contract $contract)
    {
        return [
            'id' => $contract->id,
            'number' => $contract->number,
            'tenant_id' => $contract->tenant_id,
            'date_start' => $contract->date_start,
            'date_end' => $contract->date_end,
        ];
    }

    public function includeTenant(Contract $contract)
    {
        $tenant = $contract->tenant;
        return $this->item($tenant, new TenantTransformer);
    }

    public function includeActs(Contract $contract)
    {
        $acts = $contract->acts;
        return $this->collection($acts, new ActTransformer);
    }

    public function includeAttachments(Contract $contract)
    {
        $attachments = $contract->attachments;
        return $this->collection($attachments, new AttachmentTransformer);
    }

    public function includeContractRooms(Contract $contract)
    {
        $contractRooms = $contract->contractRooms;
        return $this->collection($contractRooms, new ContractRoomTransformer);
    }
}

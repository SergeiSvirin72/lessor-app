<?php

namespace App\Transformers;

use App\Models\Contact;
use League\Fractal\TransformerAbstract;

class ContactTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'tenant'
    ];

    /**
     * Turn this item object into a generic array
     *
     * @param Contact $contact
     * @return array
     */
    public function transform(Contact $contact)
    {
        return [
            'id' => $contact->id,
            'name' => $contact->name,
            'phone' => $contact->phone,
            'email' => $contact->email,
        ];
    }

    public function includeTenant(Contact $contact)
    {
        $tenant = $contact->tenant;
        return $this->item($tenant, new TenantTransformer);
    }
}

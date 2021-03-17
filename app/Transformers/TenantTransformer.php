<?php

namespace App\Transformers;

use App\Gateways\BalanceGateway;
use App\Models\Tenant;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\TransformerAbstract;

class TenantTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'contact', 'contracts', 'balances', 'balance'
    ];

    /**
     * Turn this item object into a generic array
     *
     * @param Tenant $tenant
     * @return array
     */
    public function transform(Tenant $tenant)
    {
        return [
            'id' => $tenant->id,
            'owner_id' => $tenant->owner_id,
            'security_payment' => $tenant->security_payment,
            'inn' => $tenant->inn,
            'kpp' => $tenant->kpp,
            'ogrn' => $tenant->ogrn,
            'status' => $tenant->status,
            'full_name' => $tenant->full_name,
            'short_name' => $tenant->short_name,
            'address' => $tenant->address,
            'okpo' => $tenant->okpo,
            'okato' => $tenant->okato,
            'oktmo' => $tenant->oktmo,
            'okogu' => $tenant->okogu,
            'okfs' => $tenant->okfs,
            'debt' => $tenant->debt,
        ];
    }

    public function includeContact(Tenant $tenant)
    {
        $contact = $tenant->contact;
        return $this->item($contact, new ContactTransformer);
    }

    public function includeContracts(Tenant $tenant)
    {
        $contracts = $tenant->contracts()->orderBy('created_at', 'desc')->get();
        return $this->collection($contracts, new ContractTransformer);
    }

    public function includeActs(Tenant $tenant)
    {
        $acts = $tenant->acts()->orderBy('created_at', 'desc')->get();
        return $this->collection($acts, new ActTransformer);
    }

    public function includeBalances(Tenant $tenant)
    {
//        $paginator = $tenant->balances()->orderBy('created_at', 'desc')->paginate(3)->withQueryString()->fragment('tab');
//        $balances = $paginator->getCollection();
//        return $this->collection($balances, new BalanceTransformer)->setPaginator(new IlluminatePaginatorAdapter($paginator));
    }

    public function includeBalance(Tenant $tenant)
    {
        $balanceGateway = new BalanceGateway();
        $balance = $balanceGateway->countAmount($tenant->balances()->get());
        return $this->item($balance, function($balance) {
            return [
                'balance' => $balance
            ];
        });
    }
}

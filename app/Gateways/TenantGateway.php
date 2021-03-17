<?php

namespace App\Gateways;

use App\Http\Requests\Tenants\TenantWebCreateRequest;
use App\Http\Requests\Tenants\TenantWebUpdateRequest;
use App\Models\Tenant;
use Exception;
use Fomvasss\Dadata\Facades\DadataSuggest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TenantGateway
{
    /**
     * Находит и возвращает информацию об арендаторе через DaData API по ИНН.
     *
     * @param string $inn
     * @return Tenant|null
     */
    public function get($inn)
    {
        try {
            $result = DadataSuggest::partyById($inn, ["branch_type"=>"MAIN"])['data'];
            $tenant = new Tenant([
                'inn' => $result['inn'],
                'kpp' => $result['kpp'],
                'ogrn' => $result['ogrn'],
                'status' => $result['state']['status'],
                'full_name' => $result['name']['full_with_opf'],
                'short_name' => $result['name']['short_with_opf'],
                'address' => $result['address']['unrestricted_value'],
                'okpo' => $result['okpo'],
                'okato' => $result['okato'],
                'oktmo' => $result['oktmo'],
                'okogu' => $result['okogu'],
                'okfs' => $result['okfs'],
            ]);
            return $tenant;
        } catch (Exception $e) {
            return null;
        }
    }

    /**
     * Создает арендатора и контактных лиц.
     *
     * @param TenantWebCreateRequest $request
     * @return Tenant|null
     */
    public function create(TenantWebCreateRequest $request)
    {
        if ($tenant = $this->get($request->inn)) {
            return DB::transaction(function() use ($request, $tenant) {
                $tenant->fill([
                    'document_full_name' => $request->document_full_name,
                    'document_short_name' => $request->document_short_name,
                ]);
                Auth::user()->team->tenants()->save($tenant);
                $tenant->contact()->create([
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'email' => $request->email
                ]);
                return $tenant;
            });
        } else {
            return null;
        }
    }

    /**
     * Обновляет арендатора и контактных лиц.
     *
     * @param TenantWebUpdateRequest $request
     * @param Tenant $tenant
     * @return Tenant
     */
    public function update(TenantWebUpdateRequest $request, Tenant $tenant)
    {
        $tenant->update([
            'security_payment' => $request->security_payment
        ]);

        $tenant->contact->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email
        ]);

        return $tenant;
    }
}

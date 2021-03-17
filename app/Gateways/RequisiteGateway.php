<?php

namespace App\Gateways;

use App\Http\Requests\Requisite\RequisiteWebCreateRequest;
use App\Models\Requisite;
use Illuminate\Support\Facades\Auth;

class RequisiteGateway
{
    /**
     * Создает реквизит.
     *
     * @param RequisiteWebCreateRequest $request
     * @return Requisite
     */
    public function create(RequisiteWebCreateRequest $request)
    {
        $requisite = new Requisite($request->validated());
        Auth::user()->team->requisites()->save($requisite);
        return $requisite;
    }
}

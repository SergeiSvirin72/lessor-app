<?php

namespace App\Http\Controllers;

use App\Exports\ActiveContractsExport;
use App\Gateways\ContractGateway;
use App\Http\Requests\Contracts\ContractWebCreateRequest;
use App\Http\Requests\Templates\TemplateWebExportRequest;
use App\Models\Contract;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Tenant $tenant
     * @return \Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create(Tenant $tenant)
    {
        $this->authorize('create', [Contract::class, $tenant]);

        return view('contracts.create', [
            'tenant' => $tenant,
            'tenants' => Auth::user()->team->tenants,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ContractWebCreateRequest $request
     * @param ContractGateway $gateway
     * @param Tenant $tenant
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(ContractWebCreateRequest $request, ContractGateway $gateway, Tenant $tenant)
    {
        $this->authorize('create', [Contract::class, $tenant]);

        $gateway->create($request);
        return redirect('/tenants/'.$tenant->id.'?tab=contracts#tab');
    }

    /**
     * Display the specified resource.
     *
     * @param Tenant $tenant
     * @param Contract $contract
     * @return \Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Tenant $tenant, Contract $contract)
    {
        $this->authorize('view', [$contract, $tenant]);

        return view('contracts.show', [
            'tenant' => $tenant,
            'tenants' => $contract->tenants,
            'contract' => $contract,
            'attachments' => $contract->attachments,
            'templates' => Auth::user()->team->templates,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return void
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return void
     */
    public function destroy($id)
    {
        //
    }


    public function export(TemplateWebExportRequest $request, ContractGateway $gateway, Tenant $tenant, Contract $contract)
    {
        $result = $gateway->export($request, $contract);
        return redirect('/tenants/'.$tenant->id.'/contracts/'.$contract->id)->with('status', (bool) $result);
    }

    public function activeContractsExport()
    {
        return Excel::download(new ActiveContractsExport, 'active_contracts.xlsx');
    }
}

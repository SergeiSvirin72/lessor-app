<?php

namespace App\Http\Controllers;

use App\Exports\DebtorTenantsExport;
use App\Gateways\TenantGateway;
use App\Http\Requests\Tenants\TenantWebCreateRequest;
use App\Http\Requests\Tenants\TenantWebUpdateRequest;
use App\Models\ContractRoom;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('tenants.index', [
            'tenants' => Auth::user()->team->tenants,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('tenants.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TenantWebCreateRequest $request
     * @param TenantGateway $gateway
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TenantWebCreateRequest $request, TenantGateway $gateway)
    {
        $gateway->create($request);
        return redirect('/tenants');
    }

    /**
     * Display the specified resource.
     *
     * @param Tenant $tenant
     * @return \Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Tenant $tenant)
    {
        $this->authorize('view', $tenant);

        $contractRooms = ContractRoom::whereHas('contract.contractTenants', function (Builder $query) use ($tenant) {
            return $query->where('tenant_id', $tenant->id);
        })->with('room.floor.estate')->get();

        $bills = $tenant->bills()
            ->with(['requisite', 'contract', 'act'])
            ->simplePaginate(10)
            ->withQueryString()
            ->fragment('tab');

        $balances = $tenant->balances()
            ->simplePaginate(3)
            ->withQueryString()
            ->fragment('tab');

        return view('tenants.show', [
            'tenant' => $tenant,
            'contact' => $tenant->contact,
            'contracts' => $tenant->contracts,
            'contractRooms' => $contractRooms,
            'bills' => $bills,
            'balances' => $balances,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Tenant $tenant
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Tenant $tenant)
    {
        $this->authorize('update', $tenant);

        return view('tenants.edit', [
            'tenant' => $tenant,
            'contact' => $tenant->contact
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TenantWebUpdateRequest $request
     * @param TenantGateway $gateway
     * @param Tenant $tenant
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(TenantWebUpdateRequest $request, TenantGateway $gateway, Tenant $tenant)
    {
        $this->authorize('update', $tenant);

        $gateway->update($request, $tenant);
        return redirect('/tenants/'.$tenant->id.'?tab=contracts');
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

    /**
     * Получить организацию по ИНН.
     *
     * @param TenantGateway $gateway
     * @param $inn
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function get(TenantGateway $gateway, $inn = null)
    {
        $tenant = $gateway->get($inn);
        return view('tenants.get', [
            'tenant' => $tenant,
        ]);
    }

    public function debtorTenantsExport()
    {
        return Excel::download(new DebtorTenantsExport, 'debtor_tenants.xlsx');
    }
}

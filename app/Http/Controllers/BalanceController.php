<?php

namespace App\Http\Controllers;

use App\Gateways\BalanceGateway;
use App\Http\Requests\Balance\BalanceWebCreateRequest;
use App\Http\Requests\ReviseExportRequest;
use App\Models\Balance;
use App\Models\Tenant;
use Illuminate\Http\Request;

class BalanceController extends Controller
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
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create(Tenant $tenant)
    {
        $this->authorize('create', [Balance::class, $tenant]);

        return view('balances.create', [
            'tenant' => $tenant,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BalanceWebCreateRequest $request
     * @param BalanceGateway $gateway
     * @param Tenant $tenant
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(BalanceWebCreateRequest $request, BalanceGateway $gateway, Tenant $tenant)
    {
        $this->authorize('create', [Balance::class, $tenant]);

        $gateway->create($request);
        return redirect('/tenants/'.$tenant->id.'?tab=balances#tab');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return void
     */
    public function show($id)
    {
        //
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

    public function reviseExport(ReviseExportRequest $request, BalanceGateway $gateway, Tenant $tenant)
    {
        $result = $gateway->export($request, $tenant);
//        return view('exports.revise_export', $result);

        return redirect()->to(url()->previous().'#tab');
    }
}

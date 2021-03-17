<?php

namespace App\Http\Controllers;

use App\Gateways\ActGateway;
use App\Gateways\BillGateway;
use App\Http\Requests\Bill\BillWebCreateRequest;
use App\Http\Requests\Bill\BillWebUpdateRequest;
use App\Models\Bill;
use App\Models\Tenant;
use Illuminate\Support\Facades\Auth;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('bills.index', [
            'bills' => Bill::notPaid()->belongingTeam()->with(['requisite', 'tenant'])->simplePaginate(10)
        ]);
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
        $this->authorize('create', [Bill::class, $tenant]);

        return view('bills.create', [
            'tenant' => $tenant,
            'requisites' => Auth::user()->team->requisites,
            'contracts' => $tenant->contracts
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BillWebCreateRequest $request
     * @param BillGateway $gateway
     * @param Tenant $tenant
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(BillWebCreateRequest $request, BillGateway $gateway, Tenant $tenant)
    {
        $this->authorize('create', [Bill::class, $tenant]);

        $gateway->create($request);
        return redirect('/tenants/'.$tenant->id.'?tab=bills#tab');
    }

    /**
     * Display the specified resource.
     *
     * @param Tenant $tenant
     * @param Bill $bill
     * @return \Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Tenant $tenant, Bill $bill)
    {
        $this->authorize('view', [$bill, $tenant]);

        return view('bills.show', [
            'bill' => $bill,
            'contract' => $bill->contract,
            'requisite' => $bill->requisite,
            'attachments' => $bill->attachments,
            'services' => $bill->services
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Tenant $tenant
     * @param Bill $bill
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Tenant $tenant, Bill $bill)
    {
        $this->authorize('update', [$bill, $tenant]);

        return view('bills.edit', [
            'bill' => $bill,
            'tenant' => $tenant,
            'requisites' => Auth::user()->team->requisites,
            'contracts' => $tenant->contracts
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BillWebUpdateRequest $request
     * @param BillGateway $gateway
     * @param Tenant $tenant
     * @param Bill $bill
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(BillWebUpdateRequest $request, BillGateway $gateway, Tenant $tenant, Bill $bill)
    {
        $this->authorize('update', [$bill, $tenant]);

        $gateway->update($request, $bill);
        return redirect('/tenants/'.$tenant->id.'?tab=bills#tab');
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
     * Оплатить акт.
     *
     * @param BillGateway $gateway
     * @param Tenant $tenant
     * @param Bill $bill
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function pay(BillGateway $gateway, Tenant $tenant, Bill $bill)
    {
        $this->authorize('update', [$bill, $tenant]);

        $bill = $gateway->pay($bill);
        return redirect()->to(url()->previous().'#tab')->with('status', $bill->status);
    }

    public function act(ActGateway $gateway, Tenant $tenant, Bill $bill) {
        $gateway->create($bill);
        return redirect()->to(url()->previous().'#tab');
    }
}

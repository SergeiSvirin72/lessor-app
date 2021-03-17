<?php

namespace App\Http\Controllers;

use App\Gateways\RequisiteGateway;
use App\Http\Requests\Requisite\RequisiteWebCreateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequisiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('requisites.index', [
            'requisites' => Auth::user()->team->requisites,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('requisites.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RequisiteWebCreateRequest $request
     * @param RequisiteGateway $gateway
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(RequisiteWebCreateRequest $request, RequisiteGateway $gateway)
    {
        $gateway->create($request);
        return redirect('/requisites');
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
}

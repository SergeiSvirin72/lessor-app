<?php

namespace App\Http\Controllers;

use App\Gateways\StatementGateway;
use App\Http\Requests\Statements\StatementWebCreateRequest;
use App\Http\Requests\Statements\StatementWebUpdateRequest;
use App\Imports\StatementsImport;
use App\Models\Statement;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class StatementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $team = Auth::user()->team;
        return view('statements.index', [
            'statements' => $team->statements()->notActive()->simplePaginate(10),
            'tenants' => $team->tenants,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('statements.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StatementWebCreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StatementWebCreateRequest $request)
    {
        Excel::import(new StatementsImport(), $request->file('file'));
        return redirect('/statements')->with('status', true);
    }

    /**
     * Display the specified resource.
     *
     * @param Statement $statement
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Statement $statement)
    {
        return view('statements.show', [
            'statement' => $statement,
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
     * @param StatementWebUpdateRequest $request
     * @param StatementGateway $gateway
     * @param Statement $statement
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StatementWebUpdateRequest $request, StatementGateway $gateway, Statement $statement)
    {
        $statement = $gateway->update($request, $statement);
        return back()->with('updated', $statement->status);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param StatementGateway $gateway
     * @param Statement $statement
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(StatementGateway $gateway, Statement $statement)
    {
        $statement = $gateway->delete($statement);
        return back()->with('deleted', $statement->deleted_at);
    }
}

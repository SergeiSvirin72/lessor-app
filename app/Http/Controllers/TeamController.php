<?php

namespace App\Http\Controllers;

use App\Gateways\TeamGateway;
use App\Http\Requests\Teams\TeamWebCreateRequest;
use App\Http\Requests\Teams\TeamWebSelectRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('teams.select', [
            'teams' => Auth::user()->teams
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('teams.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TeamWebCreateRequest $request
     * @param TeamGateway $gateway
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TeamWebCreateRequest $request, TeamGateway $gateway)
    {
        $gateway->create($request);
        return redirect('/teams');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function show()
    {
        return view('teams.show', [
            'team' => Auth::user()->team
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

    public function select(TeamWebSelectRequest $request)
    {
        Auth::user()->update($request->validated());
        return redirect('/');
    }
}

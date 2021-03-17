<?php

namespace App\Exports;

use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;

class ActiveContractsExport implements FromView
{
    public function view(): View
    {
//        $contracts = Auth::user()->team->contracts()->where(function ($query) {
//            $query->debtor();
//        })->orWhere(function ($query) {
//            $query->active();
//        })->with('tenant')->get();

        $contractRooms = DB::table('contract_room')
            ->join('contracts', function ($join) {
                $join->on('contract_room.contract_id', '=', 'contracts.id')
                    ->where([
                        ['date_start', '<=', Carbon::today()],
                        ['date_end', '>=', Carbon::today()]
                    ]);
            })->get();

        dd($contractRooms);

        $tenants = Auth::user()->team->tenants()
            ->with(['contracts' => function ($query) {
                $query->where(function ($query) {
                    $query->debtor();
                })->orWhere(function ($query) {
                    $query->active();
                });
            }])
            ->with('contractRooms.room')->get();

        dd($tenants);

        return view('exports.contracts.active', [
            'tenants' => $tenants
        ]);
    }
}

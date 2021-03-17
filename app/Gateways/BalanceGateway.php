<?php

namespace App\Gateways;

use App\Http\Requests\Balance\BalanceWebCreateRequest;
use App\Http\Requests\ReviseExportRequest;
use App\Models\Balance;
use App\Models\Tenant;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Illuminate\Database\Eloquent\Collection;

class BalanceGateway
{
    /**
     * Создает баланс.
     *
     * @param BalanceWebCreateRequest $request
     * @return Balance
     */
    public function create(BalanceWebCreateRequest $request)
    {
        $balance = new Balance($request->validated());
        $request->tenant->balances()->save($balance);
        return $balance;
    }

    /**
     * Вычисляет количество средст.
     *
     * @param Collection $balances
     * @return int
     */
    public function countAmount(Collection $balances)
    {
        $balances = $balances->where('status', Balance::STATUS_DONE);
        $up = (int) $balances->where('type', Balance::TYPE_DEBIT)->sum('amount');
        $down = (int) $balances->where('type', Balance::TYPE_CREDIT)->sum('amount');
        return $up - $down;
    }

    public function export(ReviseExportRequest $request, Tenant $tenant) {
        $bills = $tenant->bills()->with(['act', 'tenant.team'])
            ->where([
                ['bills.created_at', '<', $request->date_end],
                ['bills.created_at', '>', $request->date_start],
            ])->get();

//        return [
//            'bills' => $bills,
//            'date_start' => Carbon::parse($request->date_start),
//            'date_end' => Carbon::parse($request->date_end),
//            'team' => $tenant->team,
//            'tenant' => $tenant,
//        ];

        $content = view('exports.revise_export', [
            'bills' => $bills,
            'date_start' => Carbon::parse($request->date_start),
            'date_end' => Carbon::parse($request->date_end),
            'team' => $tenant->team,
            'tenant' => $tenant,
        ])->render();

        $dompdf = new DomPDF();
        $dompdf->loadHtml($content);
        $dompdf->render();
        $dompdf->stream("revise.pdf");
    }
}

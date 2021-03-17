<?php

namespace App\Gateways;

use App\Models\Act;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\DB;

class ActGateway
{
    public function create($bill)
    {
        return DB::transaction(function() use ($bill) {
            $act = new Act([
                'amount' => $bill->amount,
                'comment' => $bill->comment,
                'path' => 'public/acts/act_'.$bill->id.'.pdf'
            ]);
            $bill->act()->save($act);
            $this->export($act);
            return $act;
        });
    }

    public function export(Act $act)
    {
        $act = $act->with(['bill.tenant.team', 'bill.contract', 'bill.services'])->find($act->id);
        $content = view('exports.act_export', [
            'act' => $act
        ])->render();

        $dompdf = new DomPDF();
        $dompdf->loadHtml($content);
        $dompdf->render();
        $output = $dompdf->output();

        $document_name = storage_path('app/public/acts/').'act_'.$act->id.'.pdf';
        file_put_contents($document_name, $output);
    }
}
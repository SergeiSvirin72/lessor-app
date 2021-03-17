<?php

namespace App\Gateways;

use Jenssegers\Date\Date;
use App\Http\Requests\Bill\BillWebCreateRequest;
use App\Http\Requests\Bill\BillWebRequest;
use App\Http\Requests\Bill\BillWebUpdateRequest;
use App\Models\Attachment;
use App\Models\Bill;
use App\Models\Balance;
use App\Models\ContractRoom;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BillGateway
{
    /**
     * Создает счет и загружает приложения к нему.
     *
     * @param BillWebCreateRequest $request
     * @return Bill
     */
    public function create(BillWebCreateRequest $request)
    {
        return DB::transaction(function() use ($request) {
            $bill = new Bill($request->validated());
            $request->tenant->bills()->save($bill);
            $bill->services()->createMany($request->services);
            $this->attach($request, $bill);
            $this->export($bill);
            return $bill;
        });
    }

    /**
     * Обновляет счет и загружает файлы к нему.
     *
     * @param BillWebUpdateRequest $request
     * @param Bill $bill
     * @return Bill
     */
    public function update(BillWebUpdateRequest $request, Bill $bill)
    {
        return DB::transaction(function() use ($request, $bill) {
            $bill->update($request->validated());

            Storage::delete($bill->attachments->pluck('attachments.path'));
            $bill->attachments()->delete();

            $this->attach($request, $bill);

            return $bill;
        });
    }

    /**
     * Загружает приложения к счету.
     *
     * @param BillWebRequest $request
     * @param Bill $bill
     */
    public function attach(BillWebRequest $request, Bill $bill)
    {
        if ($request->has('attachments')) {
            $attachmentGateway = app(AttachmentGateway::class);
            $attachments = $attachmentGateway->createAll($request->attachments, 'public/bills');
            $bill->attachments()->saveMany($attachments);
        }
    }

    /**
     * Создает счет для истекшей аренды.
     */
    public function createForExpired()
    {
        ContractRoom::expiring()->where('price_square_foot', '<>', 0)->each(function($contractRoom) {
            $months_delay = $contractRoom->months_delay;
            $bills_count = $contractRoom->contract->bills()->notPaid()->auto()->count();
            $bills_to_create = $months_delay - $bills_count;

            $date = Carbon::now()->toDateString();

            $tenants = $contractRoom->contract->tenants;
            $price = round($contractRoom->price / $tenants->count(), 2, PHP_ROUND_HALF_UP);

            for ($i = 0; $i < $bills_to_create; $i++) {
                $bill = new Bill([
                    'contract_id' => $contractRoom->contract_id,
                    'price' => $contractRoom->price,
                    'type' => Bill::TYPE_AUTO,
                    'comment' => 'Оплата за '.Carbon::parse($date)->subMonthsNoOverflow($bills_to_create - $i - 1)->format('F Y')
                ]);
                $bill->save();
            }
        });
    }

    /**
     * Оплачивает все счета.
     */
    public function payAll()
    {
        Bill::notPaid()->each(function($bill) {
            $this->pay($bill);
        });
    }

    /**
     * Оплачивет счет, создает баланс, если на счету достаточно средств.
     *
     * @param Bill $bill
     * @return Bill
     */
    public function pay(Bill $bill) {
        $balanceGateway = app(BalanceGateway::class);
        $amount = $balanceGateway->countAmount($bill->tenant->balances);

        if ($amount >= $bill->amount) {
            DB::transaction(function() use ($bill) {
                $balance = new Balance([
                    'bill_id' => $bill->id,
                    'tenant_id' => $bill->tenant_id,
                    'type' => Balance::TYPE_CREDIT,
                    'amount' => $bill->amount,
                ]);
                $balance->save();
                $bill->update(['status' => true]);
            });
        }

        return $bill;
    }

    public function export(Bill $bill) {
        $bill = $bill->with(['tenant.team', 'contract', 'services', 'requisite'])->find($bill->id);
        $content = view('exports.bill_export', [
            'bill' => $bill
        ])->render();

        $dompdf = new DomPDF();
        $dompdf->loadHtml($content);
        $dompdf->render();
        $output = $dompdf->output();

        $document_name = storage_path('app/public/bills/').'bill_'.$bill->id.'.pdf';
        file_put_contents($document_name, $output);

        $attachment = new Attachment(['path' => 'public/bills/bill_'.$bill->id.'.pdf' ]);
        $bill->attachments()->save($attachment);
        return $attachment;
    }
}

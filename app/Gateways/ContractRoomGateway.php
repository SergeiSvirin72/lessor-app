<?php

namespace App\Gateways;

use App\Http\Requests\ContractRoom\ContractRoomWebCreateRequest;
use App\Models\ContractRoom;
use Carbon\Carbon;

class ContractRoomGateway
{
    /**
     * Создает ContractRoom. Paid_till вычисляется прибавлением месяца к pay_start.
     *
     * @param ContractRoomWebCreateRequest $request
     * @return ContractRoom
     */
    public function create(ContractRoomWebCreateRequest $request)
    {
        $contractRoom = new ContractRoom($request->validated());
        $contractRoom->fill([
            'paid_till' => $request->pay_start
        ]);
        $contractRoom->save();
        return $contractRoom;
    }

    /**
     * Продляет аренду у ContractRoom на месяц.
     *
     * @param ContractRoom $contractRoom
     * @return ContractRoom
     */
    public function updateExpire(ContractRoom $contractRoom)
    {
        $contractRoom->update([
            'paid_till' => Carbon::parse($contractRoom->paid_till)
                ->addMonthsNoOverflow(1),
        ]);
        return $contractRoom;
    }
}

<?php

namespace App\Gateways;

use App\Http\Requests\Statements\StatementWebUpdateRequest;
use App\Models\Balance;
use App\Models\Statement;
use Illuminate\Support\Facades\DB;

class StatementGateway
{
    /**
     * Создает баланс по выписке.
     *
     * @param StatementWebUpdateRequest $request
     * @param Statement $statement
     * @return Statement
     */
    public function update(StatementWebUpdateRequest $request, Statement $statement) {
        DB::transaction(function() use ($request, $statement) {
            $balance = new Balance([
                'tenant_id' => $request->tenant_id,
                'amount' => $statement->amount,
                'comment' => $statement->purpose
            ]);
            $balance->save();
            $statement->update(['status' => true,]);
        });
        return $statement;
    }


    /**
     * Удалить выписку.
     *
     * @param Statement $statement
     * @return Statement
     * @throws \Exception
     */
    public function delete(Statement $statement) {
        $statement->delete();
        return $statement;
    }
}
<?php

namespace Database\Seeders;

use App\Models\Bill;
use App\Models\Balance;
use App\Models\Contract;
use App\Models\ContractRoom;
use Illuminate\Database\Seeder;

class BillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contractRooms = ContractRoom::withTrashed()->get();
        $contractRooms->each(function ($contractRoom) {
            $bills = Bill::factory()->times(rand(1, 5))->create([
                'contract_id' => $contractRoom->contract_id,
                'requisite_id' => $contractRoom->room->floor->estate->team->requisites()->inRandomOrder()->first(),
                'price' => $contractRoom->room->price_square_foot,
                'type' => 1
            ]);

            $bills->each(function ($bill) use ($contractRoom) {
                Balance::factory()->create([
                    'tenant_id' => $contractRoom->contract->tenant_id,
                    'bill_id' => $bill->id,
                    'amount' => $bill->price,
                    'type' => 2,
                    'status' => $bill->status ? 1 : 2,
                ]);
            });
        });
    }
}

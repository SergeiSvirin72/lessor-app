<?php

namespace Database\Seeders;

use App\Models\Contract;
use App\Models\ContractRoom;
use App\Models\Room;
use App\Models\Tenant;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ContractRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rooms = Room::all();
        $rooms->each(function ($room) {
            $team = $room->floor->estate->team_id;
            $tenants = Tenant::where('team_id', $team)->inRandomOrder()->limit(rand(1, 2))->get();

            $flag = null;
            if (rand(0, 1)) { $flag = Carbon::now(); }

            $tenants->each(function ($tenant) use ($room, &$flag) {
                $contract = Contract::factory()->create([
                    'date_start' => Carbon::now()->subWeeks(rand(1, 52)),
                    'date_end' => Carbon::now()->addWeeks(rand(1, 52)),
                    'tenant_id' => $tenant->id
                ]);

                $moved_at = Carbon::now()->subWeeks(rand(10, 26))->subDays(rand(1, 28))->toDateString();
                $pay_start = Carbon::parse($moved_at)->startOfMonth()->addMonth()->toDateString();
                $paid_till = Carbon::parse($pay_start)->addMonthsNoOverflow(rand(12, 36))->toDateString();

                $contractRoom = ContractRoom::factory()->create([
                    'room_id' => $room->id,
                    'moved_at' => $moved_at,
                    'pay_start' => $pay_start,
                    'paid_till' => $paid_till,
                    'deleted_at' => $flag,
                    'contract_id' => $contract->id,
                    'price_square_foot' => $room->price,
                ]);

                if (!$flag) {
                    $flag = Carbon::now();
                }
            });
        });
    }
}

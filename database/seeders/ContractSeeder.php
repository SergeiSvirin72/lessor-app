<?php

namespace Database\Seeders;

use App\Models\Contract;
use App\Models\Tenant;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ContractSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tenants = Tenant::all();
        $tenants->each(function ($tenant) {
            $tenant->contracts()->saveMany(Contract::factory()->times(rand(1, 3))->make([
                'date_start' => Carbon::now()->subWeeks(rand(1, 52)),
                'date_end' => Carbon::now()->addWeeks(rand(1, 52)),
            ]));
        });
    }
}

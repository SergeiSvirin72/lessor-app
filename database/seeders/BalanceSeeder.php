<?php

namespace Database\Seeders;

use App\Models\Balance;
use App\Models\Tenant;
use Illuminate\Database\Seeder;

class BalanceSeeder extends Seeder
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
            Balance::factory()->times(rand(5, 10))->create([
                'tenant_id' => $tenant->id,
                'type' => 1,
            ]);
        });
    }
}

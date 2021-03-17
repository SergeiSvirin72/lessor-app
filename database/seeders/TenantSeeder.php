<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\Tenant;
use Illuminate\Database\Seeder;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teams = Team::all();
        $teams->each(function ($team) {
            $team->tenants()->saveMany(Tenant::factory()->times(rand(3, 5))->make());
        });
    }
}

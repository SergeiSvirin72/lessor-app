<?php

namespace Database\Seeders;

use App\Models\Requisite;
use App\Models\Team;
use Illuminate\Database\Seeder;

class RequisiteSeeder extends Seeder
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
            $team->requisites()->saveMany(Requisite::factory()->times(rand(1, 3))->make());
        });
    }
}

<?php

namespace Database\Seeders;

use App\Models\Estate;
use App\Models\Team;
use Illuminate\Database\Seeder;

class EstateSeeder extends Seeder
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
            $team->estates()->saveMany(Estate::factory()->times(rand(5, 7))->make());
        });
    }
}

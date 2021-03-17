<?php

namespace Database\Seeders;

use App\Models\Estate;
use App\Models\Floor;
use Illuminate\Database\Seeder;

class FloorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estates = Estate::all();
        $estates->each(function ($estate) {
            $estate->floors()->saveMany(Floor::factory()->times(rand(1, 3))->make());
        });
    }
}

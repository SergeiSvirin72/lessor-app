<?php

namespace Database\Seeders;

use App\Models\Floor;
use App\Models\Room;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $floors = Floor::all();
        $floors->each(function ($floor) {
            $floor->rooms()->saveMany(Room::factory()->times(rand(1, 3))->make());
        });
    }
}

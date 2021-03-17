<?php

namespace Database\Seeders;

use App\Models\Estate;
use App\Models\Image;
use App\Models\Room;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $estates = Estate::all();
        $estates->each(function ($estate) use ($faker) {
            $estate->images()->saveMany(Image::factory()->times(1)->make([
                'img' => 'public/estates/'
                .$faker->image('public/storage/estates', 640, 480, 'estate', false)
            ]));
        });

        $rooms = Room::all();
        $rooms->each(function ($room) use ($faker) {
            $room->images()->saveMany(Image::factory()->times(1)->make([
                'img' => 'public/rooms/'
                    .$faker->image('public/storage/rooms', 640, 480, 'room', false)
            ]));
        });
    }
}

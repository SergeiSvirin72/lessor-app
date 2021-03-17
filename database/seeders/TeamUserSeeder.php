<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class TeamUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $owners = User::all();
        $owners->each(function ($owner) {
            $users = User::factory()->times(rand(2, 5))->create();
            $users->each(function ($user) use ($owner) {
                $teams = $owner->teams()->inRandomOrder()->limit(rand(0, 2))->get();
                $user->teams()->attach($teams->pluck('id'), ['role' => 2]);
            });
        });
    }
}

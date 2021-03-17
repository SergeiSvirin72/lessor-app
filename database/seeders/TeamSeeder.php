<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $team = Team::create([
            'name' => 'Team 1',
            'alias' => 'team-1'
        ]);
        User::find(1)->teams()->attach($team->id, ['role' => 1]);

        $team = Team::create([
            'name' => 'Team 2',
            'alias' => 'team-2'
        ]);
        User::find(1)->teams()->attach($team->id, ['role' => 1]);

//        $users = User::all();
//        $users->each(function ($user) {
//            $teams = Team::factory()->times(rand(1, 3))->create();
//            $user->teams()->attach($teams->pluck('id'), ['role' => 1]);
//        });
    }
}

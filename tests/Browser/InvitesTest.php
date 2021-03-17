<?php

namespace Tests\Browser;

use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class InvitesTest extends DuskTestCase
{
    use DatabaseMigrations;

    protected $user_1, $user_2, $team;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user_2 = User::factory()->create();
        $this->team = Team::factory()->create();
        $this->user_1 = User::factory()->create(['team_id' => $this->team->id]);
        $this->user_1->teams()->attach($this->team->id, ['role' => 1]);
    }

    /**
     * A Dusk test example.
     *
     * @return void
     * @throws
     */
    public function testInvite()
    {
        $this->browse(function (Browser $first, Browser $second) {
            $first->loginAs($this->user_1)
                ->visit('/employees')
                ->press('Получить ссылку приглашения');

            $link = $first->text('#link');

            $second->loginAs($this->user_2)
                ->visit('/teams')
                ->assertDontSee($this->team->name)
                ->visit($link)
                ->assertSee($this->team->name);
        });
    }
}

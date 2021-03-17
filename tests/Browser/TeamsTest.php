<?php

namespace Tests\Browser;

use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class TeamsTest extends DuskTestCase
{
    use DatabaseMigrations;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    /**
     * A Dusk test example.
     *
     * @return void
     * @throws
     */
    public function testIndex()
    {
        $this->browse(function (Browser $browser) {
            $team_1 = Team::factory()->create(['name' => 'Team 1', 'alias' => 'team-1']);
            $team_2 = Team::factory()->create(['name' => 'Team 2', 'alias' => 'team-2']);
            $this->user->teams()->attach($team_1->id, ['role' => 1]);
            $this->user->teams()->attach($team_2->id, ['role' => 1]);

            $browser->loginAs($this->user)
                ->visit('/teams')
                ->click('#teams')
                ->assertSee($team_1->name)
                ->assertSee($team_2->name);
        });
    }

    /**
     * A Dusk test example.
     *
     * @return void
     * @throws
     */
    public function testCreate()
    {
        $this->browse(function (Browser $browser) {
            $values = [
                'name' => 'Team',
                'alias' => 'team',
                'document_full_name' => 'Team Document Full Name',
                'document_short_name' => 'Team Document Short Name',
                'document_signature' => 'Team Document Signature',
            ];

            $browser->loginAs($this->user)
                ->visit('/teams/create')
                ->type('name', $values['name'])
                ->type('alias', $values['alias'])
                ->type('document_full_name', $values['document_full_name'])
                ->type('document_short_name', $values['document_short_name'])
                ->type('document_signature', $values['document_signature'])
                ->press('Сохранить')
                ->assertPathIs('/teams')
                ->assertSee($values['name']);
        });
    }
}

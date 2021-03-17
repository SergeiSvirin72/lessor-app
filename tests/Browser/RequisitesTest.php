<?php

namespace Tests\Browser;

use App\Models\Requisite;
use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RequisitesTest extends DuskTestCase
{
    use DatabaseMigrations;

    protected $user, $team;

    protected function setUp(): void
    {
        parent::setUp();

        $this->team = Team::factory()->create();
        $this->user = User::factory()->create(['team_id' => $this->team->id]);
        $this->user->teams()->attach($this->team->id, ['role' => 1]);
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
            $requisite_1 = Requisite::factory()->create(['team_id' => $this->team->id]);
            $requisite_2 = Requisite::factory()->create(['team_id' => $this->team->id]);

            $browser->loginAs($this->user)
                ->visit('/requisites')
                ->assertSee($requisite_1->name)
                ->assertSee($requisite_2->name);
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
                'name' => 'Requisite',
                'inn' => 'INN',
                'bik' => 'BIK',
                'account' => 'Account',
            ];

            $browser->loginAs($this->user)
                ->visit('/requisites/create')
                ->type('name', $values['name'])
                ->type('inn', $values['inn'])
                ->type('bik', $values['bik'])
                ->type('account', $values['account'])
                ->press('Сохранить')
                ->assertPathIs('/requisites')
                ->assertSee($values['name']);
        });
    }
}

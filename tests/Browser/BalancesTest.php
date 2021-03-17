<?php

namespace Tests\Browser;

use App\Models\Balance;
use App\Models\Contact;
use App\Models\Team;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class BalancesTest extends DuskTestCase
{
    use DatabaseMigrations;

    protected $user, $team, $tenant;

    protected function setUp(): void
    {
        parent::setUp();

        $this->team = Team::factory()->create();
        $this->user = User::factory()->create(['team_id' => $this->team->id]);
        $this->user->teams()->attach($this->team->id, ['role' => 1]);
        $this->tenant = Tenant::factory()->create(['team_id' => $this->team->id]);
        $this->contact = Contact::factory()->create(['tenant_id' => $this->tenant->id]);
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
            $balance_1 = Balance::factory()->create(['tenant_id' => $this->tenant->id]);
            $balance_2 = Balance::factory()->create(['tenant_id' => $this->tenant->id]);

            $browser->loginAs($this->user)
                ->visit('/tenants/'.$this->tenant->id.'?tab=balances#tab')
                ->assertSee($balance_1->amount)
                ->assertSee($balance_2->amount);
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
                'amount' => 10000,
                'comment' => 'Comment',
            ];

            $browser->loginAs($this->user)
                ->visit('/tenants/'.$this->tenant->id.'/balances/create')
                ->type('amount', $values['amount'])
                ->type('comment', $values['comment'])
                ->press('Сохранить')
                ->assertPathIs('/tenants/'.$this->tenant->id)
                ->assertQueryStringHas('tab')
                ->assertFragmentIs('tab')
                ->assertSee($values['amount'])
                ->assertSee($values['comment'])
                ->assertSee('Дебит');
        });
    }
}

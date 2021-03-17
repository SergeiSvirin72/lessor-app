<?php

namespace Tests\Browser;

use App\Models\Contact;
use App\Models\Contract;
use App\Models\Team;
use App\Models\Tenant;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ContractsTest extends DuskTestCase
{
    use DatabaseMigrations;

    protected $user, $team, $tenant, $contact;

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
            $contract_1 = Contract::factory()->create();
            $contract_2 = Contract::factory()->create();
            $this->tenant->contracts()->sync([$contract_1->id, $contract_2->id]);

            $browser->loginAs($this->user)
                ->visit('/tenants/'.$this->tenant->id.'?tab=contracts#tab')
                ->assertSee($contract_1->number)
                ->assertSee($contract_2->number);
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
            $date_start = Carbon::now()->subWeeks(rand(1, 52));
            $date_end = Carbon::now()->addWeeks(rand(1, 52));

            $values = [
                'number' => 'Number',
                'date_start' => $date_start->day.$date_start->month.$date_start->year,
                'date_end' => $date_end->day.$date_end->month.$date_end->year,
                'attachments' => __DIR__.'/test_image.jpg',
                'security_payment' => 10000
            ];

            $browser->loginAs($this->user)
                ->visit('/tenants/'.$this->tenant->id.'/contracts/create')
                ->attach('attachments[]', $values['attachments'])
                ->select('tenants[]', $this->tenant->id)
                ->type('number', $values['number'])
                ->type('date_start', $values['date_start'])
                ->type('date_end', $values['date_end'])
                ->type('security_payment', $values['security_payment'])
                ->press('Сохранить')
                ->assertPathIs('/tenants/'.$this->tenant->id)
                ->assertQueryStringHas('tab')
                ->assertFragmentIs('tab')
                ->assertSee($values['number'])
                ->clickLink($values['number'])
                ->assertSee('Download');
        });
    }

    /**
     * A Dusk test example.
     *
     * @return void
     * @throws
     */
    public function testShow()
    {
        $this->browse(function (Browser $browser) {
            $contract = Contract::factory()->create();
            $this->tenant->contracts()->sync([$contract->id]);

            $browser->loginAs($this->user)
                ->visit('/tenants/'.$this->tenant->id.'/contracts/'.$contract->id)
                ->assertSee($contract->number)
                ->assertSee($contract->date_start->format('Y-m-d'))
                ->assertSee($contract->date_end->format('Y-m-d'));
        });
    }
}

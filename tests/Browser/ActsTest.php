<?php

namespace Tests\Browser;

use App\Models\Bill;
use App\Models\Balance;
use App\Models\Contact;
use App\Models\Contract;
use App\Models\Requisite;
use App\Models\Service;
use App\Models\Team;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ActsTest extends DuskTestCase
{
    use DatabaseMigrations;

    protected $user, $team, $tenant, $contact, $contract, $requisite;

    protected function setUp(): void
    {
        parent::setUp();

        $this->team = Team::factory()->create();
        $this->user = User::factory()->create(['team_id' => $this->team->id]);
        $this->user->teams()->attach($this->team->id, ['role' => 1]);
        $this->tenant = Tenant::factory()->create(['team_id' => $this->team->id]);
        $this->contact = Contact::factory()->create(['tenant_id' => $this->tenant->id]);
        $this->contract = Contract::factory()->create();
        $this->tenant->contracts()->sync([$this->contract->id]);
        $this->requisite = Requisite::factory()->create(['team_id' => $this->team->id]);
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
            $bill_1 = Bill::factory()->create(['contract_id' => $this->contract->id, 'tenant_id' => $this->tenant->id]);
            $bill_2 = Bill::factory()->create(['contract_id' => $this->contract->id, 'tenant_id' => $this->tenant->id]);

            $browser->loginAs($this->user)
                ->visit('/tenants/'.$this->tenant->id.'?tab=bills#tab')
                ->assertSee($bill_1->number)
                ->assertSee($bill_2->number);
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
                'number' => 'Bill',
                'attachments' => __DIR__.'/test_image.jpg',
                'contract_id' => $this->contract->id,
                'requisite_id' => $this->requisite->id,
                'name' => 'Rent',
                'quantity' => '2',
                'measure' => 'pc',
                'price' => '1234'
            ];

            $browser->loginAs($this->user)
                ->visit('/tenants/'.$this->tenant->id.'/bills/create')
                ->attach('attachments[]', $values['attachments'])
                ->type('number', $values['number'])
                ->select('contract_id', $values['contract_id'])
                ->select('requisite_id', $values['requisite_id'])
                ->type('services[0][name]', $values['name'])
                ->type('services[0][quantity]', $values['quantity'])
                ->type('services[0][measure]', $values['measure'])
                ->type('services[0][price]', $values['price'])
                ->press('Сохранить')
                ->assertPathIs('/tenants/'.$this->tenant->id)
                ->assertQueryStringHas('tab')
                ->assertFragmentIs('tab')
                ->assertSee($values['number']);
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
            $bill = Bill::factory()->create([
                'contract_id' => $this->contract->id,
                'requisite_id' => $this->requisite->id,
                'tenant_id' => $this->tenant->id,
            ]);
            $service = $bill->services()->save(Service::factory()->make([
                'name' => 'Rent',
                'quantity' => '2',
                'measure' => 'pc',
                'price' => '1234'
            ]));

            $browser->loginAs($this->user)
                ->visit('/tenants/'.$this->tenant->id.'/bills/'.$bill->id)
                ->assertSee($bill->number)
                ->assertSee($this->requisite->name)
                ->assertSee($service->name)
                ->assertSee($service->quantity)
                ->assertSee($service->measure)
                ->assertSee($service->price)
                ->assertSee($bill->status ? 'Оплачен' : 'Не оплачен');
        });
    }

    /**
     * A Dusk test example.
     *
     * @return void
     * @throws
     */
    public function testPaid()
    {
        $this->browse(function (Browser $browser) {
            $balance = Balance::factory()->create([
                'tenant_id' => $this->tenant->id,
                'type' => Balance::TYPE_DEBIT,
                'status' => Balance::STATUS_DONE,
                'amount' => 9000
            ]);

            $bill = Bill::factory()->create([
                'contract_id' => $this->contract->id,
                'requisite_id' => $this->requisite->id,
                'tenant_id' => $this->tenant->id,
            ]);
            $service = $bill->services()->save(Service::factory()->make([
                'name' => 'Rent',
                'quantity' => '2',
                'measure' => 'pc',
                'price' => '1234'
            ]));

            $browser->loginAs($this->user)
                ->visit('/tenants/'.$this->tenant->id.'?tab=bills#tab')
                ->press('Оплатить')
                ->assertSee('Оплачен')
                ->visit('/tenants/'.$this->tenant->id.'?tab=balances#tab')
                ->assertSee('Кредит');
        });
    }

    /**
     * A Dusk test example.
     *
     * @return void
     * @throws
     */
    public function testNotPaid()
    {
        $this->browse(function (Browser $browser) {
            $bill = Bill::factory()->create([
                'contract_id' => $this->contract->id,
                'requisite_id' => $this->requisite->id,
                'tenant_id' => $this->tenant->id,
            ]);
            $service = $bill->services()->save(Service::factory()->make([
                'name' => 'Rent',
                'quantity' => '2',
                'measure' => 'pc',
                'price' => '1234'
            ]));

            $browser->loginAs($this->user)
                ->visit('/tenants/'.$this->tenant->id.'?tab=bills#tab')
                ->press('Оплатить')
                ->assertSee('Недостаточно средств');
        });
    }

    /**
     * A Dusk test example.
     *
     * @return void
     * @throws
     */
    public function testActCreate()
    {
        $this->browse(function (Browser $browser) {
            $bill = Bill::factory()->create([
                'contract_id' => $this->contract->id,
                'requisite_id' => $this->requisite->id,
                'tenant_id' => $this->tenant->id,
            ]);
            $service = $bill->services()->save(Service::factory()->make([
                'name' => 'Rent',
                'quantity' => '2',
                'measure' => 'pc',
                'price' => '1234'
            ]));

            $browser->loginAs($this->user)
                ->visit('/tenants/'.$this->tenant->id.'?tab=bills#tab')
                ->press('Создать')
                ->clickLink('Загрузить')
                ->assertPathIs($bill->act->document_url)
                ->assertSee('Акт');
        });
    }
}

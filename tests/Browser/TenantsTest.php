<?php

namespace Tests\Browser;

use App\Models\Contact;
use App\Models\Team;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class TenantsTest extends DuskTestCase
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
            $tenant_1 = Tenant::factory()->create(['team_id' => $this->team->id]);
            $tenant_2 = Tenant::factory()->create(['team_id' => $this->team->id]);

            $browser->loginAs($this->user)
                ->visit('/tenants')
                ->assertSee($tenant_1->short_name)
                ->assertSee($tenant_2->short_name);
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
                'inn' => '7723517121',
                'name' => 'John Doe',
                'email' => 'John@Doe',
                'phone' => '+79876543210',
                'document_full_name' => 'Tenant Document Full Name',
                'document_short_name' => 'Tenant Document Short Name',
            ];

            $browser->loginAs($this->user)
                ->visit('/tenants/create')
                ->type('inn', $values['inn'])
                ->type('name', $values['name'])
                ->type('email', $values['email'])
                ->type('phone', $values['phone'])
                ->type('document_full_name', $values['document_full_name'])
                ->type('document_short_name', $values['document_short_name'])
                ->press('Получить')
                ->waitForText('Сохранить')
                ->press('Сохранить')
                ->assertPathIs('/tenants')
                ->assertSee('"АГАПЕ"');
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
            $tenant = Tenant::factory()->create(['team_id' => $this->team->id]);
            $contact = Contact::factory()->create(['tenant_id' => $tenant->id]);

            $browser->loginAs($this->user)
                ->visit('/tenants/'.$tenant->id)
                ->assertSee($tenant->short_name)
                ->assertSee($tenant->full_name)
                ->assertSee($tenant->security_payment)
                ->assertSee($tenant->inn)
                ->assertSee($tenant->kpp)
                ->assertSee($tenant->ogrn)
                ->assertSee($tenant->status)
                ->assertSee($tenant->okpo)
                ->assertSee($tenant->okato)
                ->assertSee($tenant->oktmo)
                ->assertSee($tenant->okogu)
                ->assertSee($tenant->okfs)
                ->assertSee($contact->name)
                ->assertSee($contact->email)
                ->assertSee($contact->phone);
        });
    }

    /**
     * A Dusk test example.
     *
     * @return void
     * @throws
     */
    public function testUpdate()
    {
        $this->browse(function (Browser $browser) {
            $tenant = Tenant::factory()->create(['team_id' => $this->team->id]);
            $contact = Contact::factory()->create(['tenant_id' => $tenant->id]);

            $values = [
                'name' => 'John Doe',
                'email' => 'John@Doe',
                'phone' => '+79876543210',
            ];

            $browser->loginAs($this->user)
                ->visit('/tenants/'.$tenant->id.'/edit')
                ->type('name', $values['name'])
                ->type('email', $values['email'])
                ->type('phone', $values['phone'])
                ->press('Сохранить')
                ->assertPathIs('/tenants/'.$tenant->id)
                ->assertSee($values['name'])
                ->assertSee($values['email'])
                ->assertSee($values['phone']);
        });
    }
}

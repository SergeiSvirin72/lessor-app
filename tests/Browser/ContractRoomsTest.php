<?php

namespace Tests\Browser;

use App\Models\Contact;
use App\Models\Contract;
use App\Models\Estate;
use App\Models\Floor;
use App\Models\Room;
use App\Models\Team;
use App\Models\Tenant;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ContractRoomsTest extends DuskTestCase
{
    use DatabaseMigrations;

    protected $user, $team, $estate, $floor, $room, $tenant, $contact, $contract;

    protected function setUp(): void
    {
        parent::setUp();

        $this->team = Team::factory()->create();
        $this->user = User::factory()->create(['team_id' => $this->team->id]);
        $this->user->teams()->attach($this->team->id, ['role' => 1]);

        $this->estate = Estate::factory()->create(['team_id' => $this->team->id]);
        $this->floor = Floor::factory()->create(['name' => 'Floor', 'estate_id' => $this->estate->id]);
        $this->room = Room::factory()->create(['name' => 'Room', 'floor_id' => $this->floor->id]);

        $this->tenant = Tenant::factory()->create(['team_id' => $this->team->id]);
        $this->contact = Contact::factory()->create(['tenant_id' => $this->tenant->id]);
        $this->contract = Contract::factory()->create();
        $this->tenant->contracts()->sync([$this->contract->id]);
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
            $date = Carbon::now();

            $values = [
                'estate_id' => $this->estate->id,
                'floor_id' => $this->floor->id,
                'room_id' => $this->room->id,
                'contract_id' => $this->contract->id,
                'price_square_foot' => 10000,
                'moved_at' => $date->format('d').$date->format('m').$date->year,
                'pay_start' => $date->format('d').$date->format('m').$date->year,
            ];

            $browser->loginAs($this->user)
                ->visit('/tenants/'.$this->tenant->id.'/contractRooms/create')
                ->select('estate_id', $values['estate_id'])
                ->waitForText($this->floor->name)
                ->select('floor_id', $values['floor_id'])
                ->waitForText($this->room->name)
                ->select('room_id', $values['room_id'])
                ->type('price_square_foot', $values['price_square_foot'])
                ->type('moved_at', $values['moved_at'])
                ->type('pay_start', $values['pay_start'])
                ->select('contract_id', $values['contract_id'])
                ->press('Сохранить')
                ->assertPathIs('/tenants/'.$this->tenant->id)
                ->assertQueryStringHas('tab')
                ->assertFragmentIs('tab')
                ->assertSee($this->room->name)
                ->visit('/estates/'.$this->estate->id.'/rooms/'.$this->room->id)
                ->assertSee($this->tenant->short_name);
        });
    }
}

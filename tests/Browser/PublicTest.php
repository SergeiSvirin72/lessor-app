<?php

namespace Tests\Browser;

use App\Models\Application;
use App\Models\Contract;
use App\Models\ContractRoom;
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

class PublicTest extends DuskTestCase
{
    use DatabaseMigrations;

    protected $team;

    protected function setUp(): void
    {
        parent::setUp();

        $this->team = Team::factory()->create();
    }

    /**
     * A Dusk test example.
     *
     * @return void
     * @throws
     */
    public function testEstates()
    {
        $this->browse(function (Browser $browser) {
            $estate_1 = Estate::factory()->create(['team_id' => $this->team->id, 'status' => true]);
            $estate_2 = Estate::factory()->create(['team_id' => $this->team->id, 'status' => false]);

            $browser->visit($this->team->getPublicUrl().'/estates')
                ->assertSee($estate_1->name)
                ->assertDontSee($estate_2->name);
        });
    }

    /**
     * A Dusk test example.
     *
     * @return void
     * @throws
     */
    public function testSendApplication()
    {
        $this->browse(function (Browser $browser) {
            $estate = Estate::factory()->create(['team_id' => $this->team->id]);
            $floor = Floor::factory()->create(['name' => 'Floor', 'estate_id' => $estate->id]);
            $room = Room::factory()->create(['name' => 'Room', 'floor_id' => $floor->id]);

            $user = User::factory()->create();
            $user->teams()->attach($this->team->id, ['role' => 1]);

            $date = Carbon::now();
            $values = [
                'phone' => '+79876543210',
                'name' => 'John Doe',
                'date' => $date->format('d').$date->format('m').$date->year,
            ];

            $browser->visit($this->team->getPublicUrl().'/estates/'.$estate->id.'/rooms/'.$room->id)
                ->type('phone', $values['phone'])
                ->type('name', $values['name'])
                ->type('date', $values['date'])
                ->press('Отправить')
                ->assertSee('Заявка успешно отправлена')
                ->loginAs($user)
                ->visit($this->team->getUrl().'/applications')
                ->assertSee($values['phone'])
                ->assertSee($values['name'])
                ->assertSee($room->name);
        });
    }

    /**
     * A Dusk test example.
     *
     * @return void
     * @throws
     */
    public function testHandleApplication()
    {
        $this->browse(function (Browser $browser) {
            $user = User::factory()->create();
            $user->teams()->attach($this->team->id, ['role' => 1]);
            $estate = Estate::factory()->create(['team_id' => $this->team->id]);
            $floor = Floor::factory()->create(['name' => 'Floor', 'estate_id' => $estate->id]);
            $room = Room::factory()->create(['name' => 'Room', 'floor_id' => $floor->id]);
            $application = Application::factory()->create(['room_id' => $room->id]);

            $browser->loginAs($user)
                ->visit($this->team->getUrl().'/applications')
                ->assertSee($application->phone)
                ->press('Обработать')
                ->assertDontSee($application->phone);
        });
    }

    /**
     * A Dusk test example.
     *
     * @return void
     * @throws
     */
    public function testRoomFilter()
    {
        $this->browse(function (Browser $browser) {
            $estate = Estate::factory()->create(['team_id' => $this->team->id]);
            $floor_1 = Floor::factory()->create(['name' => 'Floor 1', 'estate_id' => $estate->id]);
            $floor_2 = Floor::factory()->create(['name' => 'Floor 2', 'estate_id' => $estate->id]);
            $room_1 = Room::factory()->create(['name' => 'Room 1', 'floor_id' => $floor_1->id]);
            $room_2 = Room::factory()->create(['name' => 'Room 2', 'floor_id' => $floor_1->id]);
            $room_3 = Room::factory()->create(['name' => 'Room 3', 'floor_id' => $floor_2->id]);

            $tenant = Tenant::factory()->create(['team_id' => $this->team->id]);
            $contract = Contract::factory()->create();
            $tenant->contracts()->sync([$contract->id]);
            $contractRoom = ContractRoom::factory()->create(['room_id' => $room_2->id, 'contract_id' => $contract->id]);

            $browser->visit($this->team->getPublicUrl().'/estates/'.$estate->id)
                ->assertSee($room_1->name)
                ->assertSee($room_2->name)
                ->assertDontSee($room_3->name)
                ->select('status', 'free')
                ->press('Найти')
                ->assertSee($room_1->name)
                ->assertDontSee($room_2->name)
                ->assertDontSee($room_3->name)
                ->select('status', 'not_free')
                ->press('Найти')
                ->assertDontSee($room_1->name)
                ->assertSee($room_2->name)
                ->assertDontSee($room_3->name)
                ->select('status', 'all')
                ->select('floor_id', $floor_2->id)
                ->press('Найти')
                ->assertDontSee($room_1->name)
                ->assertDontSee($room_2->name)
                ->assertSee($room_3->name);
        });
    }
}

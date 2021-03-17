<?php

namespace Tests\Browser;

use App\Models\Estate;
use App\Models\Floor;
use App\Models\Room;
use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RoomsTest extends DuskTestCase
{
    use DatabaseMigrations;

    protected $user, $team, $estate, $floor;

    protected function setUp(): void
    {
        parent::setUp();

        $this->team = Team::factory()->create();
        $this->user = User::factory()->create(['team_id' => $this->team->id]);
        $this->user->teams()->attach($this->team->id, ['role' => 1]);
        $this->estate = Estate::factory()->create(['team_id' => $this->team->id]);
        $this->floor = Floor::factory()->create(['name' => 'Floor', 'estate_id' => $this->estate->id]);
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
            $floor_1 = Floor::factory()->create(['name' => 'Floor 1', 'estate_id' => $this->estate->id]);
            $floor_2 = Floor::factory()->create(['name' => 'Floor 2', 'estate_id' => $this->estate->id]);
            $room_1 = Room::factory()->create(['name' => 'Room 1', 'floor_id' => $floor_2->id]);
            $room_2 = Room::factory()->create(['name' => 'Room 2', 'floor_id' => $floor_2->id]);

            $browser->loginAs($this->user)
                ->visit('/estates/'.$this->estate->id)
                ->click('#options-menu')
                ->click('[data-floor="'.$floor_2->id.'"]')
                ->waitForLink('Room 1')
                ->assertSee($room_1->name)
                ->assertSee($room_2->name);
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
                'name' => 'Room',
                'size' => 200,
                'price_square_foot' => 10000,
                'floor_id' => $this->floor->id,
                'images' => __DIR__.'/test_image.jpg',
            ];

            $browser->loginAs($this->user)
                ->visit('/estates/'.$this->estate->id.'/rooms/create')
                ->attach('images[]', $values['images'])
                ->type('name', $values['name'])
                ->type('size', $values['size'])
                ->type('price_square_foot', $values['price_square_foot'])
                ->select('floor_id', $values['floor_id'])
                ->press('Сохранить')
                ->waitForLink($values['name'])
                ->assertPathIs('/estates/'.$this->estate->id)
                ->assertSee($values['name']);
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
            $room = Room::factory()->create(['floor_id' => $this->floor->id]);

            $browser->loginAs($this->user)
                ->visit('/estates/'.$this->estate->id.'/rooms/'.$room->id)
                ->assertSee($room->name)
                ->assertSee($room->size)
                ->assertSee($room->price_square_foot)
                ->assertSee($room->floor->name);
        });
    }
}

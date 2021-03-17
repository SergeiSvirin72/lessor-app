<?php

namespace Tests\Browser;

use App\Models\Estate;
use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class EstatesTest extends DuskTestCase
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
            $estate_1 = Estate::factory()->create(['team_id' => $this->team->id]);
            $estate_2 = Estate::factory()->create(['team_id' => $this->team->id]);

            $browser->loginAs($this->user)
                ->visit('/estates')
                ->assertSee($estate_1->name)
                ->assertSee($estate_2->name);
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
                'name' => 'Estate 1',
                'address' => 'Address 1',
                'longitude' => 'Longitude 1',
                'latitude' => 'Latitude 1',
                'price_square_foot' => 10000,
                'mask' => 'Mask',
                'status' => true,
                'images' => __DIR__.'/test_image.jpg',
            ];

            $browser->loginAs($this->user)
                ->visit('/estates/create')
                ->attach('images[]', $values['images'])
                ->type('name', $values['name'])
                ->type('address', $values['address'])
                ->type('longitude', $values['longitude'])
                ->type('latitude', $values['latitude'])
                ->type('price_square_foot', $values['price_square_foot'])
                ->type('mask', $values['mask'])
                ->check('status')
                ->press('Сохранить')
                ->assertPathIs('/estates')
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
            $estate = Estate::factory()->create(['team_id' => $this->team->id]);

            $browser->loginAs($this->user)
                ->visit('/estates/'.$estate->id)
                ->assertSee($estate->name)
//                ->assertSee(str_replace(["\r","\n"], "", $estate->address))
                ->assertSee($estate->longitude)
                ->assertSee($estate->latitude)
                ->assertSee($estate->status ? 'Активно' : 'Неактивно')
                ->assertSee($estate->info);
        });
    }
}

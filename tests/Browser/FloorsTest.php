<?php

namespace Tests\Browser;

use App\Models\Estate;
use App\Models\Floor;
use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class FloorsTest extends DuskTestCase
{
    use DatabaseMigrations;

    protected $user, $team, $estate;

    protected function setUp(): void
    {
        parent::setUp();

        $this->team = Team::factory()->create();
        $this->user = User::factory()->create(['team_id' => $this->team->id]);
        $this->user->teams()->attach($this->team->id, ['role' => 1]);
        $this->estate = Estate::factory()->create(['team_id' => $this->team->id]);
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

            $browser->loginAs($this->user)
                ->visit('/estates/'.$this->estate->id)
                ->click('#options-menu')
                ->waitForText($floor_1->name)
                ->assertSee($floor_1->name)
                ->assertSee($floor_2->name);
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
                'name' => 'Floor 1',
                'price_square_foot' => 10000,
                'img' => __DIR__.'/test_image.jpg',
            ];

            $browser->loginAs($this->user)
                ->visit('/estates/'.$this->estate->id.'/floors/create')
                ->type('name', $values['name'])
                ->type('price_square_foot', $values['price_square_foot'])
                ->attach('img', $values['img'])
                ->press('Сохранить')
                ->assertPathIs('/estates/'.$this->estate->id)
                ->click('#options-menu')
                ->assertSee($values['name']);
        });
    }
}

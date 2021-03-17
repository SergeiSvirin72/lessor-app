<?php

namespace Database\Factories;

use App\Models\Floor;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class FloorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Floor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'Floor',
            'img' => 'public/floors/'
                .$this->faker->image('public/storage/floors', 640, 480, 'floor', false),
            'price_square_foot' => $this->faker->numberBetween($min = 15, $max = 25) * 1000,
        ];
    }
}

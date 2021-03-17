<?php

namespace Database\Factories;

use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Room::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $coordinates = [
            [
                'x' => $this->faker->numberBetween($min = 20, $max = 620),
                'y' => $this->faker->numberBetween($min = 20, $max = 460)
            ], [
                'x' => $this->faker->numberBetween($min = 20, $max = 620),
                'y' => $this->faker->numberBetween($min = 20, $max = 460)
            ], [
                'x' => $this->faker->numberBetween($min = 20, $max = 620),
                'y' => $this->faker->numberBetween($min = 20, $max = 460)
            ], [
                'x' => $this->faker->numberBetween($min = 20, $max = 620),
                'y' => $this->faker->numberBetween($min = 20, $max = 460)
            ]
        ];

        return [
            'size' => $this->faker->numberBetween($min = 15, $max = 40),
            'price_square_foot' => $this->faker->numberBetween($min = 1, $max = 5) * 1000,
            'name' => 'Room',
            'coordinates' => json_encode($coordinates)
        ];
    }
}

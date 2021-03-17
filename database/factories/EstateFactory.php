<?php

namespace Database\Factories;

use App\Models\Estate;
use Illuminate\Database\Eloquent\Factories\Factory;

class EstateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Estate::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->streetName,
            'info' => $this->faker->text($maxNbChars = 100),
            'mask' => 'Mask',
            'longitude' => $this->faker->longitude,
            'latitude' => $this->faker->latitude,
            'address' => $this->faker->address,
            'price_square_foot' => $this->faker->numberBetween($min = 15, $max = 25) * 1000,
            'status' => $this->faker->numberBetween($min = 0, $max = 1)
        ];
    }
}

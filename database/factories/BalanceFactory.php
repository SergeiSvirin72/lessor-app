<?php

namespace Database\Factories;

use App\Models\Balance;
use Illuminate\Database\Eloquent\Factories\Factory;

class BalanceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Balance::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'amount' => $this->faker->numberBetween($min = 50, $max = 100) * 1000,
            'type' => $this->faker->numberBetween($min = 1, $max = 2),
            'status' => $this->faker->numberBetween($min = 1, $max = 2),
        ];
    }
}

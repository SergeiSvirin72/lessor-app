<?php

namespace Database\Factories;

use App\Models\Requisite;
use Illuminate\Database\Eloquent\Factories\Factory;

class RequisiteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Requisite::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'inn' => $this->faker->numberBetween($min = 1000000000, $max = 9999999999999),
            'bik' => $this->faker->numberBetween($min = 1000000000, $max = 9999999999999),
            'account' => $this->faker->numberBetween($min = 1000000000, $max = 9999999999999),
        ];
    }
}

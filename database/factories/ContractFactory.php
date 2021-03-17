<?php

namespace Database\Factories;

use App\Models\Contract;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContractFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contract::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'number' => $this->faker->phoneNumber,
            'date_start' => Carbon::now()->subWeeks(rand(1, 52)),
            'date_end' => Carbon::now()->addWeeks(rand(1, 52)),
            'security_payment' => $this->faker->numberBetween($min = 10, $max = 30) * 1000,
        ];
    }
}

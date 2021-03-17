<?php

namespace Database\Factories;

use App\Models\ContractRoom;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContractRoomFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ContractRoom::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'price_square_foot' => $this->faker->numberBetween($min = 1, $max = 5) * 1000,
            'moved_at' => Carbon::now(),
            'pay_start' => Carbon::now(),
            'paid_till' => Carbon::now()->addMonthNoOverflow()
        ];
    }
}

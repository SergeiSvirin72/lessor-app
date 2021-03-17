<?php

namespace Database\Factories;

use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

class TenantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tenant::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $statuses = ['ACTIVE', 'LIQUIDATING', 'LIQUIDATED', 'REORGANIZING'];
        $name = $this->faker->company;

        return [
            'inn' => $this->faker->numberBetween($min = 1000000000, $max = 9999999999999),
            'ogrn' => $this->faker->numberBetween($min = 1000000000, $max = 9999999999999),
            'kpp' => $this->faker->numberBetween($min = 1000000000, $max = 9999999999999),
            'okpo' => $this->faker->numberBetween($min = 1000000000, $max = 9999999999999),
            'okato' => $this->faker->numberBetween($min = 1000000000, $max = 9999999999999),
            'oktmo' => $this->faker->numberBetween($min = 1000000000, $max = 9999999999999),
            'okogu' => $this->faker->numberBetween($min = 1000000000, $max = 9999999999999),
            'okfs' => $this->faker->numberBetween($min = 1000000000, $max = 9999999999999),
            'short_name' => $name,
            'full_name' => $name,
            'address' => $this->faker->address,
            'status' => $statuses[array_rand($statuses)],
            'document_full_name' => $name,
            'document_short_name' => $name,
        ];
    }
}

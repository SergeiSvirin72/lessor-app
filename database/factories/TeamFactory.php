<?php

namespace Database\Factories;

use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeamFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Team::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->company;

        return [
            'name' => $name,
            'alias' => strtolower(str_replace(',', '-', str_replace(' ', '', $name))),
            'document_full_name' => $name,
            'document_short_name' => $name,
            'document_signature' => $this->faker->name,
        ];
    }
}

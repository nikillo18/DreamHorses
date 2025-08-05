<?php

namespace Database\Factories;

use App\Models\Horse;
use App\Models\Race;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Race>
 */
class RaceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Race::class;
    public function definition(): array
    {
        return [
            'date' => $this->faker->date(),
            'horse_id' => Horse::inRandomOrder()->first()->id,
            'place' => $this->faker->numberBetween(1, 10),
            'distance' => $this->faker->numberBetween(1000, 5000),
            'description' => $this->faker->sentence(),
            'jockey' => $this->faker->name(),
        ];
    }
}

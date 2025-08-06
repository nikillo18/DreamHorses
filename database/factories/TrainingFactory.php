<?php

namespace Database\Factories;

use App\Models\Horse;
use App\Models\Training;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Training>
 */
class TrainingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Training::class;
    public function definition(): array
    {
        return [
            'horse_id' => Horse::inRandomOrder()->first()->id,
            'date' => $this->faker->date(),
            'distance' => $this->faker->numberBetween(100, 500),
            'type_training' => $this->faker->name(),
            'duration_minutes' => $this->faker->numberBetween(10, 120),
            'comments' => $this->faker->optional()->text(200),
        ];
    }
}

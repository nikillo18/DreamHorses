<?php

namespace Database\Factories;

use App\Models\Caretaker;
use App\Models\Horse;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Horse>
 */
class HorseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Horse::class;
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'breed' => $this->faker->word(),
            'color' => $this->faker->word(),
            'birth_date' => $this->faker->date(),
            'gender' => $this->faker->randomElement(['macho', 'hembra']),
            'father_name' => $this->faker->name(),
            'mother_name' => $this->faker->name(),
            'caretaker_id' => Caretaker::inRandomOrder()->first()->id,
        ];
    }
}

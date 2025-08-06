<?php

namespace Database\Factories;

use App\Models\Food;
use App\Models\Horse;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Food>
 */
class FoodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Food::class;
    public function definition(): array
    {
        return [
            'horse_id' => Horse::inRandomOrder()->first()->id,
            'date' => $this->faker->date(),
            'type_food' => $this->faker->word(),
            'quantity' => $this->faker->randomFloat(2, 0, 1000),
            'time' => $this->faker->time(),
            'notes' => $this->faker->text(200),
        ];
    }
}

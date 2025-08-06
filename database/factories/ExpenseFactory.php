<?php

namespace Database\Factories;

use App\Models\Expense;
use App\Models\Horse;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Expense>
 */
class ExpenseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Expense::class;
    public function definition(): array
    {
        return [
            'date' => $this->faker->date(),
            'category' => $this->faker->word(),
            'description' => $this->faker->text(100),
            'amount' => $this->faker->randomFloat(2, 0, 10000),
            'horse_id' => Horse::inRandomOrder()->first()->id,
        ];
    }
}

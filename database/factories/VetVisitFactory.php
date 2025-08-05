<?php

namespace Database\Factories;

use App\Models\Horse;
use App\Models\VetVisit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VetVisit>
 */
class VetVisitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = VetVisit::class;
    public function definition(): array
    {
        return [
            'horse_id' => Horse::inRandomOrder()->first()->id,
            'visit_date' => $this->faker->date(),
            'vet_name' => $this->faker->name(),
            'vet_phone' => $this->faker->phoneNumber(),
            'diagnosis' => $this->faker->text(200),
            'treatment' => $this->faker->text(200),
            'next_visit' => $this->faker->optional()->date(),

        ];
    }
}

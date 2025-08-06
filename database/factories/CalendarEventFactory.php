<?php

namespace Database\Factories;

use App\Models\CalendarEvent;
use App\Models\Horse;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CalendarEvent>
 */
class CalendarEventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = CalendarEvent::class;
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'horse_id' => Horse::inRandomOrder()->first()->id,
            'event_date' => $this->faker->date(),
            'event_time' => $this->faker->time(),
            'description' => $this->faker->paragraph,
            'category' => $this->faker->word,
        ];
    }
}

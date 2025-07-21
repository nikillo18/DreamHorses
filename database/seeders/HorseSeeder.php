<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HorseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    DB::table('horses')->insert([
            [
                'name' => fake()->name(),
                'breed' => fake()->word(),
                'color' => fake()->colorName(),
                'birth_date' => fake()->date(),
                'gender' => fake()->randomElement(['male', 'female']),
                'photo_path' => 'horses/4h7nvmv1L75udUMdo7EU9yr4mNZDSk3GWvE0ljRm.png',
                'number_microchip' => '123456789012345',
                'father_name' => fake()->name(),
                'mother_name' => fake()->name(),
                'caretaker_id' => 1,
            ],
            [
                'name' => fake()->name(),
                'breed' => fake()->word(),
                'color' => fake()->colorName(),
                'birth_date' => fake()->date(),
                'gender' => fake()->randomElement(['male', 'female']),
                'photo_path' => 'horses/dQ1inI4JvJiO52Jn4SRkWRL8G9PDvGsr62rHT8hN.png',
                'number_microchip' => fake()->unique()->numerify('###########'),
                'father_name' => fake()->name(),
                'mother_name' => fake()->name(),
                'caretaker_id' => 2,
            ],
            [
                'name' => fake()->name(),
                'breed' => fake()->word(),
                'color' => fake()->colorName(),
                'birth_date' => fake()->date(),
                'gender' => fake()->randomElement(['male', 'female']),
                'photo_path' => 'horses\zpV9ACcimWOOZ0YhJR5FTAsPoMqhEhMs2imv6dmS.png',
                'number_microchip' => fake()->unique()->numerify('###########'),
                'father_name' => fake()->name(),
                'mother_name' => fake()->name(),
                'caretaker_id' => 3,
            ],
            [
                'name' => fake()->name(),
                'breed' => fake()->word(),
                'color' => fake()->colorName(),
                'birth_date' => fake()->date(),
                'gender' => fake()->randomElement(['male', 'female']),
                'photo_path' => 'horses\L65llfW5CDECAeKwQA92wcxSlXtf9vHMehxzLJCL.png',
                'number_microchip' => fake()->unique()->numerify('###########'),
                'father_name' => fake()->name(),
                'mother_name' => fake()->name(),
                'caretaker_id' => 2,
            ],
        ]);
    }
}

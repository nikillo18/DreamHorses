<?php

namespace Database\Seeders;

use App\Models\Horse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class HorseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    /*DB::table('horses')->insert([
            [
                'name' => fake()->name(),
                'breed' => fake()->word(),
                'color' => fake()->colorName(),
                'birth_date' => fake()->date(),
                'gender' => fake()->randomElement(['male', 'female']),
                'photo_path' => 'horses/580b57fbd9996e24bc43bc2a.png',
                'number_microchip' => '123456789012345',
                'father_name' => fake()->name(),
                'mother_name' => fake()->name(),
               
            ],
            [
                'name' => fake()->name(),
                'breed' => fake()->word(),
                'color' => fake()->colorName(),
                'birth_date' => fake()->date(),
                'gender' => fake()->randomElement(['male', 'female']),
                'photo_path' => 'horses\imgane de caballo.png',
                'number_microchip' => fake()->unique()->numerify('###########'),
                'father_name' => fake()->name(),
                'mother_name' => fake()->name(),

            ],
            [
                'name' => fake()->name(),
                'breed' => fake()->word(),
                'color' => fake()->colorName(),
                'birth_date' => fake()->date(),
                'gender' => fake()->randomElement(['male', 'female']),
                'photo_path' => 'horses\caras de caballo 3.png',
                'number_microchip' => fake()->unique()->numerify('###########'),
                'father_name' => fake()->name(),
                'mother_name' => fake()->name(),
                
            ],
            [
                'name' => fake()->name(),
                'breed' => fake()->word(),
                'color' => fake()->colorName(),
                'birth_date' => fake()->date(),
                'gender' => fake()->randomElement(['male', 'female']),
                'photo_path' => 'horses/5a02c1e918e87004f1ca439f.png',
                'number_microchip' => fake()->unique()->numerify('###########'),
                'father_name' => fake()->name(),
                'mother_name' => fake()->name(),
                
            ],
        ]);*/
    }
}

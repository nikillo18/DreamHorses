<?php

namespace Database\Seeders;

use App\Models\Horse;
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
                'photo_path' => 'horses\3f0e0MMRZNkRVx8vxYY5Yl4YP8wDRdslbw3h37Kk.png',
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
                'photo_path' => 'horses\KtzZ0gvgAVFbXTkF450SxTgdDpMU7B45VptoFwA1.png',
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
                'photo_path' => 'horses\VMTkZn56cAAKpu4T8R5xaecr5E915W1WeJDXeqHv.png',
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
                'photo_path' => 'horses\DTGIHmooqjvLu50xZldLUrvKaBr2n7lQjElMMKM0.png',
                'number_microchip' => fake()->unique()->numerify('###########'),
                'father_name' => fake()->name(),
                'mother_name' => fake()->name(),
                'caretaker_id' => 2,
            ],
        ]);
    }
}

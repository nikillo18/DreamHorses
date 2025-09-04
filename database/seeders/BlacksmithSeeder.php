<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlacksmithSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('blacksmiths')->insert([
            [
                'horse_id' => 1,
                'date' => '2023-01-15',
                'name' => 'Juan Pérez',
                'horseshoe' => 'Herradura Completa',
            ],
            [
                'horse_id' => 2,
                'date' => '2023-02-20',
                'name' => 'Carlos Gómez',
                'horseshoe' => 'Herradura Media',
            ],
            [
                'horse_id' => 3,
                'date' => '2023-03-10',
                'name' => 'Luis Martínez',
                'horseshoe' => 'Herradura Ligera',

            ],
        ]);
    }
}

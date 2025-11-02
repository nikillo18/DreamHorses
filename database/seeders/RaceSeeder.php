<?php

namespace Database\Seeders;

use App\Models\Race;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

       /* DB::table('races')->insert([[
            'hipodromo' => 'palermo',
            'video' => 'https://www.youtube.com/embed/MvwlKML3HFc/?autoplay=true&rel=0',
            'date' => '2020-05-15',
            'horse_id' => 1,
            'place' => 10 ,
            'distance' => 1200,
            'description' => 'Gran premio pelegrini',
            'jockey' => 'Juan Perez',
        ],
        [
            'hipodromo' => 'San Isidro',
            'video' => 'https://www.youtube.com/watch?v=q3r0G4dD1QY&t=1s',
            'date' => '2020-03-28',
            'horse_id' => 2,
            'place' => 2,
            'distance' => 1400,
            'description' => 'Clásico de San Isidro',
            'jockey' => 'Carlos Gomez',
        ]]);*/
    }
}

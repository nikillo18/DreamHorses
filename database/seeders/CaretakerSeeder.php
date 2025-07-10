<?php

namespace Database\Seeders;

use App\Models\Caretaker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CaretakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Caretaker::factory(10)->create();
    }
}

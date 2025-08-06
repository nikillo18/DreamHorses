<?php

namespace Database\Seeders;

use App\Models\VetVisit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VetVisitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        VetVisit::factory(10)->create();
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CaretakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('caretakers')->insert([
            ['name' => 'John Doe','phone'=> '123456', 'address'=> 'molinari'],
            ['name' => 'Jane Smith', 'phone'=> '123455', 'address'=> 'barracas'],
            ['name' => 'Carlos Garcia', 'phone'=> '123464', 'address'=> 'belgrano'],
            ['name' => 'Maria Rodriguez', 'phone'=> '123466', 'address'=> 'concordia'],
            ['name' => 'Luis Fernandez', 'phone'=> '1234697', 'address'=> 'san martin'],
        ]);
    }
}


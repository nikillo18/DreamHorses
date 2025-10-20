<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $role = Role::firstOrCreate(['name' => 'caretaker']);

        foreach (range(1, 5) as $i) {
            $user = User::create([
                'name' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'password' => bcrypt('password'),
                'phone' => fake()->phoneNumber(),
                'address' => fake()->address(),
            ]);

            $user->assignRole($role); 
        }
    }

}
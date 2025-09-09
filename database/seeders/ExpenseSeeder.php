<?php

namespace Database\Seeders;

use App\Models\Expense;
use App\Models\Horse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $horseIds = Horse::pluck('id')->toArray();
        if (empty($horseIds)) {
            // If no horses, create some for the seeder to work
            Horse::factory(5)->create();
            $horseIds = Horse::pluck('id')->toArray();
        }

        $categories = ['Alimentación', 'Veterinario', 'Herrero', 'Entrenamiento', 'Equipamiento', 'Varios'];

        for ($month = 1; $month <= 12; $month++) {
            // Create a random number of expenses for each month (e.g., 3 to 8)
            $numberOfExpenses = rand(3, 8);

            for ($j = 0; $j < $numberOfExpenses; $j++) {
                $category = $categories[array_rand($categories)];
                Expense::create([
                    'date' => Carbon::create(2025, $month, rand(1, 28)),
                    'category' => $category,
                    'description' => 'Gasto en ' . strtolower($category),
                    'amount' => rand(100, 2500) + (rand(0, 99) / 100), // More realistic amounts
                    'horse_id' => $horseIds[array_rand($horseIds)],
                ]);
            }
        }
    }
}
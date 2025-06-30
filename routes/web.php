<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RaceController;
use App\Http\Controllers\TrainingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/training', [TrainingController::class, 'index'])->name('training.index');
Route::get('/training/create', [TrainingController::class, 'create'])->name('training.create');
Route::post('/training', [TrainingController::class, 'store'])->name('training.store');
Route::get('/training/{training}/edit', [TrainingController::class, 'edit'])->name('training.edit');
Route::put('/training/{training}', [TrainingController::class, 'update'])->name('training.update');
Route::delete('/training/{training}', [TrainingController::class, 'destroy'])->name('training.destroy');

/* Race */
Route::get('/race', [RaceController::class, 'index'])->name('race.index');
Route::get('/race/create', [RaceController::class, 'create'])->name('race.create');
Route::post('/race', [RaceController::class, 'store'])->name('race.store');
Route::get('/race/{race}/edit', [RaceController::class, 'edit'])->name('race.edit');
Route::put('/race/{race}', [RaceController::class, 'update'])->name('race.update');
Route::delete('/race/{race}', [RaceController::class, 'destroy'])->name('race.destroy');
require __DIR__ . '/auth.php';

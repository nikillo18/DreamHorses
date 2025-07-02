<?php

use App\Http\Controllers\HorseController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HorsePhotoController;

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

require __DIR__.'/auth.php';

Route::get('CreateHorse', [HorseController::class, 'create'])->name('CreateHorse');
Route::post('StoreHorse', [HorseController::class, 'store'])->name('StoreHorse');
Route::get('Horseindex', [HorseController::class, 'index'])->name('Horseindex');
Route::get('horses/{horse}', [HorseController::class, 'show'])->name('horses.show');
Route::get('horses/{horse}/edit', [HorseController::class, 'edit'])->name('horses.edit');
Route::put('horses/{horse}', [HorseController::class, 'update'])->name('horses.update');
Route::delete('horses/{horse}', [HorseController::class, 'destroy'])->name('horses.destroy');
Route::delete('/photos/{photo}', [HorsePhotoController::class, 'destroy'])->name('photos.destroy');




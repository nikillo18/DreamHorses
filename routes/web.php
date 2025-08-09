<?php

use App\Http\Controllers\HorseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RaceController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\VetVisitController;
use App\Http\Controllers\HorsePhotoController;
use App\Http\Controllers\ExpenseController;
use App\Models\Expense;
use App\Models\Horse;
use App\Models\Race;
use App\Models\VetVisit;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $horses = Horse::with('caretaker')->get();
    $nextRaces = Race::where('date', '>=', now())->orderBy('date')->get();
    $nextVetVisits = VetVisit::where('visit_date', '>=', now())->orderBy('visit_date')->get();
    $expenses = Expense::selectRaw('horse_id, SUM(amount) as total')
        ->groupBy('horse_id')->get()->keyBy('horse_id');
    $alerts = VetVisit::whereBetween('visit_date', [now(), now()->addDays(7)])->get();

    return view('dashboard', compact('horses', 'nextRaces', 'nextVetVisits', 'expenses', 'alerts'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/* Training */
Route::get('/training', [TrainingController::class, 'index'])->name('training.index');
Route::get('/training/create', [TrainingController::class, 'create'])->name('training.create');
Route::post('/training', [TrainingController::class, 'store'])->name('training.store');
Route::get('/training/{training}/edit', [TrainingController::class, 'edit'])->name('training.edit');
Route::put('/training/{training}', [TrainingController::class, 'update'])->name('training.update');
Route::delete('/training/{training}', [TrainingController::class, 'destroy'])->name('training.destroy');

/* Vet Visits */
Route::get('/vet-visits', [VetVisitController::class, 'index'])->name('vet-visits.index');
Route::get('/vet-visits/create', [VetVisitController::class, 'create'])->name('vet-visits.create');
Route::post('/vet-visits', [VetVisitController::class, 'store'])->name('vet-visits.store');
Route::get('/vet-visits/{vetVisit}/edit', [VetVisitController::class, 'edit'])->name('vet-visits.edit');
Route::put('/vet-visits/{vetVisit}', [VetVisitController::class, 'update'])->name('vet-visits.update');
Route::delete('/vet-visits/{vetVisit}', [VetVisitController::class, 'destroy'])->name('vet-visits.destroy');

/* Horse */
Route::get('CreateHorse', [HorseController::class, 'create'])->name('CreateHorse');
Route::post('StoreHorse', [HorseController::class, 'store'])->name('StoreHorse');
Route::get('Horseindex', [HorseController::class, 'index'])->name('Horseindex');
Route::get('horses/{horse}', [HorseController::class, 'show'])->name('horses.show');
Route::get('horses/{horse}/edit', [HorseController::class, 'edit'])->name('horses.edit');
Route::put('horses/{horse}', [HorseController::class, 'update'])->name('horses.update');
Route::delete('horses/{horse}', [HorseController::class, 'destroy'])->name('horses.destroy');
Route::delete('/photos/{photo}', [HorsePhotoController::class, 'destroy'])->name('photos.destroy');

/* Race */
Route::get('/race', [RaceController::class, 'index'])->name('race.index');
Route::get('/race/create', [RaceController::class, 'create'])->name('race.create');
Route::post('/race', [RaceController::class, 'store'])->name('race.store');
Route::get('/race/{race}/edit', [RaceController::class, 'edit'])->name('race.edit');
Route::put('/race/{race}', [RaceController::class, 'update'])->name('race.update');
Route::delete('/race/{race}', [RaceController::class, 'destroy'])->name('race.destroy');

/* Expense */
Route::get('/expenses', [ExpenseController::class, 'index'])->name('expenses.index');
Route::get('/expenses/create', [ExpenseController::class, 'create'])->name('expenses.create');
Route::post('/expenses', [ExpenseController::class, 'store'])->name('expenses.store');
Route::get('/expenses/{expense}', [ExpenseController::class, 'show'])->name('expenses.show');
Route::get('/expenses/{expense}/edit', [ExpenseController::class, 'edit'])->name('expenses.edit');
Route::put('/expenses/{expense}', [ExpenseController::class, 'update'])->name('expenses.update');
Route::delete('/expenses/{expense}', [ExpenseController::class, 'destroy'])->name('expenses.destroy');

/* Roles */

require __DIR__.'/auth.php';


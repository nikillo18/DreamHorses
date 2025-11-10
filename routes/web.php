<?php

use App\Http\Controllers\HorseController;
use App\Http\Controllers\CalendarEventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RaceController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\VetVisitController;
use App\Http\Controllers\HorsePhotoController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\CaretakerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\BlacksmithController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudController;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/* Training */
Route::get('/training', [TrainingController::class, 'index'])->name('training.index')->middleware('role:boss|caretaker|admin');
Route::get('/training/create', [TrainingController::class, 'create'])->name('training.create')->middleware('role:caretaker|admin');
Route::post('/training', [TrainingController::class, 'store'])->name('training.store')->middleware('role:caretaker|admin');
Route::get('/training/{training}/edit', [TrainingController::class, 'edit'])->name('training.edit')->middleware('role:caretaker|admin');
Route::put('/training/{training}', [TrainingController::class, 'update'])->name('training.update')->middleware('role:caretaker|admin');
Route::delete('/training/{training}', [TrainingController::class, 'destroy'])->name('training.destroy')->middleware('role:caretaker|admin');

/* Vet Visits */
Route::get('/vet-visits', [VetVisitController::class, 'index'])->name('vet-visits.index')->middleware('role:boss|caretaker|admin');
Route::get('/vet-visits/create', [VetVisitController::class, 'create'])->name('vet-visits.create')->middleware('role:caretaker|admin');
Route::post('/vet-visits', [VetVisitController::class, 'store'])->name('vet-visits.store')->middleware('role:caretaker|admin');
Route::get('/vet-visits/{vetVisit}/edit', [VetVisitController::class, 'edit'])->name('vet-visits.edit')->middleware('role:caretaker|admin');
Route::put('/vet-visits/{vetVisit}', [VetVisitController::class, 'update'])->name('vet-visits.update')->middleware('role:caretaker|admin');
Route::delete('/vet-visits/{vetVisit}', [VetVisitController::class, 'destroy'])->name('vet-visits.destroy')->middleware('role:caretaker|admin');

/* Horse */
Route::get('CreateHorse', [HorseController::class, 'create'])->name('CreateHorse')->middleware('role:boss|admin');
Route::post('StoreHorse', [HorseController::class, 'store'])->name('StoreHorse')->middleware('role:caretaker|boss|admin|');
Route::get('Horseindex', [HorseController::class, 'index'])->name('Horseindex')->middleware('role:boss|caretaker|admin');
Route::get('horses/{horse}', [HorseController::class, 'show'])->name('horses.show')->middleware('role:boss|caretaker|admin');
Route::get('horses/{horse}/edit', [HorseController::class, 'edit'])->name('horses.edit')->middleware('role:boss|caretaker|admin');
Route::put('horses/{horse}', [HorseController::class, 'update'])->name('horses.update')->middleware('role:boss|caretaker|admin');
Route::delete('horses/{horse}', [HorseController::class, 'destroy'])->name('horses.destroy')->middleware('role:boss|admin');
Route::delete('/photos/{photo}', [HorsePhotoController::class, 'destroy'])->name('photos.destroy')->middleware('role:boss|caretaker|admin');

/* Race */
Route::get('/race', [RaceController::class, 'index'])->name('race.index')->middleware('role:boss|caretaker|admin');
Route::get('/race/create', [RaceController::class, 'create'])->name('race.create')->middleware('role:caretaker|admin');
Route::post('/race', [RaceController::class, 'store'])->name('race.store')->middleware('role:caretaker|admin');
Route::get('/race/{race}/edit', [RaceController::class, 'edit'])->name('race.edit')->middleware('role:caretaker|admin');
Route::put('/race/{race}', [RaceController::class, 'update'])->name('race.update')->middleware('role:caretaker|admin');
Route::delete('/race/{race}', [RaceController::class, 'destroy'])->name('race.destroy')->middleware('role:caretaker|admin');

/* Expense */
Route::get('/expenses', [ExpenseController::class, 'index'])->name('expenses.index')->middleware('role:boss|caretaker|admin');
Route::get('/expenses/chart', [ExpenseController::class, 'chart'])->name('expenses.chart')->middleware('role:boss|caretaker|admin');
Route::get('/expenses/summary', [ExpenseController::class, 'summary'])->name('expenses.summary')->middleware('role:boss|caretaker|admin');
Route::post('expenses/summary/pdf', [ExpenseController::class, 'downloadSummaryPdf'])->name('expenses.summary.pdf')->middleware('role:boss|caretaker|admin');

Route::get('/expenses/pdf', [ExpenseController::class, 'downloadPdf'])->name('expenses.pdf');

Route::get('/expenses/create', [ExpenseController::class, 'create'])->name('expenses.create')->middleware('role:caretaker|admin');
Route::post('/expenses', [ExpenseController::class, 'store'])->name('expenses.store')->middleware('role:caretaker|admin');
Route::get('/expenses/{expense}', [ExpenseController::class, 'show'])->name('expenses.show')->middleware('role:caretaker|admin');
Route::get('/expenses/{expense}/edit', [ExpenseController::class, 'edit'])->name('expenses.edit')->middleware('role:caretaker|admin');
Route::put('/expenses/{expense}', [ExpenseController::class, 'update'])->name('expenses.update')->middleware('role:caretaker|admin');
Route::delete('/expenses/{expense}', [ExpenseController::class, 'destroy'])->name('expenses.destroy')->middleware('role:caretaker|boss|admin');

/* Roles */
Route::get('/select-role', function () {
    return view('auth.select-role');
})->name('select-role');

Route::get('/register', [RegisteredUserController::class, 'create'])
    ->name('register');

Route::post('/register', [RegisteredUserController::class, 'store']);

/* Caretakers*/

Route::get('/caretakers', [CaretakerController::class, 'index'])->name('caretakers.index')->middleware('role:boss|admin');
Route::get('/caretakers/{caretaker}', [CaretakerController::class, 'show'])->name('caretakers.show')->middleware('role:boss|admin');
Route::delete('/caretakers/{caretaker}', [CaretakerController::class, 'destroy'])->name('caretakers.destroy')->middleware('role:boss|admin');
Route::post('/caretakers/{caretaker}/reassign', [CaretakerController::class, 'reassign'])->name('caretakers.reassign')->middleware('role:boss|admin');


/* Herreria */

Route::get('/blacksmiths', [BlacksmithController::class, 'index'])->name('blacksmiths.index')->middleware('role:boss|caretaker|admin');

Route::get('/blacksmiths/create', [BlacksmithController::class, 'create'])->name('blacksmiths.create')->middleware('role:caretaker|admin');
Route::post('/blacksmiths', [BlacksmithController::class, 'store'])->name('blacksmiths.store')->middleware('role:caretaker|admin');
Route::get('/blacksmiths/{blacksmith}/edit', [BlacksmithController::class, 'edit'])->name('blacksmiths.edit')->middleware('role:caretaker|admin');
Route::put('/blacksmiths/{blacksmith}', [BlacksmithController::class, 'update'])->name('blacksmiths.update')->middleware('role:caretaker|admin');
Route::delete('/blacksmiths/{blacksmith}', [BlacksmithController::class, 'destroy'])->name('blacksmiths.destroy')->middleware('role:caretaker|admin');

/* Calendar */

Route::get('/calendar', [CalendarEventController::class, 'index'])->name('calendar.index')->middleware('role:boss|caretaker|admin');
Route::get('/calendar/create', [CalendarEventController::class, 'create'])->name('calendar.create')->middleware('role:caretaker|admin');
Route::post('/calendar', [CalendarEventController::class, 'store'])->name('calendar.store')->middleware('role:caretaker|admin');
Route::get('/calendar/{calendarEvent}/edit', [CalendarEventController::class, 'edit'])->name('calendar.edit')->middleware('role:caretaker|admin');
Route::put('/calendar/{calendarEvent}', [CalendarEventController::class, 'update'])->name('calendar.update')->middleware('role:caretaker|admin');
Route::delete('/calendar/{calendarEvent}', [CalendarEventController::class, 'destroy'])->name('calendar.destroy')->middleware('role:caretaker|admin');

Route::get('/calendarhorse', [CalendarEventController::class, 'calendar'])->name('calendarhorse')->middleware('role:boss|caretaker|admin');

    Route::get('/studs', [StudController::class, 'index'])->name('studs.index');
    Route::get('/studs/create', [StudController::class, 'create'])->name('studs.create');
    Route::post('/studs', [StudController::class, 'store'])->name('studs.store');
    Route::get('/studs/{stud}', [StudController::class, 'show'])->name('studs.show');
    Route::get('/studs/{stud}/edit', [StudController::class, 'edit'])->name('studs.edit');
    Route::put('/studs/{stud}', [StudController::class, 'update'])->name('studs.update');

    Route::post('/studs/{stud}/join', [StudController::class, 'join'])->name('studs.join');
    Route::post('/studs/{stud}/leave', [StudController::class, 'leave'])->name('studs.leave');
    Route::post('/studs/{stud}/kick', [StudController::class, 'kick'])->name('studs.kick');
    Route::delete('/studs/{stud}', [StudController::class, 'destroy'])->name('studs.destroy');
    
    Route::post('/studs/{stud}/hire', [StudController::class, 'hire'])->name('studs.hire');
Route::post('/studs/{stud}/fire', [StudController::class, 'fire'])->name('studs.fire');


require __DIR__ . '/auth.php';

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
use App\Models\Expense;
use App\Models\Horse;
use App\Models\Race;
use App\Models\VetVisit;
use App\Models\CalendarEvent;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $horses = Horse::with('caretaker')->paginate(6);
    $nextRaces = Race::where('date', '>=', now())->orderBy('date')->get();
    $nextVetVisits = VetVisit::where('visit_date', '>=', now())->orderBy('visit_date')->get();
    $nextCalendarEvents = CalendarEvent::where('event_date', '>=', now())->orderBy('event_date')->get();

    $events = $nextRaces->take(5)->map(function ($race) {
        return (object) [
            'horse_id' => $race->horse_id,
            'event_date' => $race->date,
            'title' => $race->name,
            'category' => 'Carrera',
        ];
    })->concat($nextVetVisits->map(function ($visit) {
        return (object) [ // Take only the next 5 events
            'horse_id' => $visit->horse_id,
            'event_date' => $visit->visit_date,
            'title' => $visit->reason,
            'category' => 'Visita Veterinaria',
        ];
    }))->concat($nextCalendarEvents->map(function ($event) {
        return (object) [
            'horse_id' => $event->horse_id,
            'event_date' => $event->event_date,
            'title' => $event->title,
            'category' => $event->category,
        ];
    }))->sortBy('event_date')->take(5);

    $expenses = Expense::selectRaw('horse_id, SUM(amount) as total')
        ->groupBy('horse_id')->get()->keyBy('horse_id');

    $vetVisitAlerts = VetVisit::whereBetween('visit_date', [now(), now()->addDays(7)])->get()->map(function ($visit) {
        return (object) [
            'horse_id' => $visit->horse_id,
            'event_date' => $visit->visit_date,
            'title' => $visit->reason,
            'category' => 'Visita Veterinaria',
        ];
    });

    $raceAlerts = Race::whereBetween('date', [now(), now()->addDays(7)])->get()->map(function ($race) {
        return (object) [
            'horse_id' => $race->horse_id,
            'event_date' => $race->date,
            'title' => $race->name,
            'category' => 'Carrera',
        ];
    });

    $calendarEventAlerts = CalendarEvent::whereBetween('event_date', [now(), now()->addDays(7)])->get()->map(function ($event) {
        return (object) [
            'horse_id' => $event->horse_id,
            'event_date' => $event->event_date,
            'title' => $event->title,
            'category' => $event->category,
        ];
    });

    $alerts = $vetVisitAlerts->concat($raceAlerts)->concat($calendarEventAlerts);

    return view('dashboard', compact('horses', 'events', 'expenses', 'alerts'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/* Training */
Route::get('/training', [TrainingController::class, 'index'])->name('training.index')->middleware('role:boss|caretaker|veterinarian');
Route::get('/training/create', [TrainingController::class, 'create'])->name('training.create')->middleware('role:caretaker');
Route::post('/training', [TrainingController::class, 'store'])->name('training.store')->middleware('role:caretaker');
Route::get('/training/{training}/edit', [TrainingController::class, 'edit'])->name('training.edit')->middleware('role:caretaker');
Route::put('/training/{training}', [TrainingController::class, 'update'])->name('training.update')->middleware('role:caretaker');
Route::delete('/training/{training}', [TrainingController::class, 'destroy'])->name('training.destroy')->middleware('role:caretaker');

/* Vet Visits */
Route::get('/vet-visits', [VetVisitController::class, 'index'])->name('vet-visits.index')->middleware('role:boss|caretaker|veterinarian');
Route::get('/vet-visits/create', [VetVisitController::class, 'create'])->name('vet-visits.create')->middleware('role:veterinarian');
Route::post('/vet-visits', [VetVisitController::class, 'store'])->name('vet-visits.store')->middleware('role:veterinarian');
Route::get('/vet-visits/{vetVisit}/edit', [VetVisitController::class, 'edit'])->name('vet-visits.edit')->middleware('role:veterinarian');
Route::put('/vet-visits/{vetVisit}', [VetVisitController::class, 'update'])->name('vet-visits.update')->middleware('role:veterinarian');
Route::delete('/vet-visits/{vetVisit}', [VetVisitController::class, 'destroy'])->name('vet-visits.destroy')->middleware('role:veterinarian');

/* Horse */
Route::get('CreateHorse', [HorseController::class, 'create'])->name('CreateHorse')->middleware('role:caretaker|boss');
Route::post('StoreHorse', [HorseController::class, 'store'])->name('StoreHorse')->middleware('role:caretaker|boss');
Route::get('Horseindex', [HorseController::class, 'index'])->name('Horseindex')->middleware('role:boss|veterinarian|caretaker');
Route::get('horses/{horse}', [HorseController::class, 'show'])->name('horses.show')->middleware('role:boss|veterinarian|caretaker');
Route::get('horses/{horse}/edit', [HorseController::class, 'edit'])->name('horses.edit')->middleware('role:caretaker');
Route::put('horses/{horse}', [HorseController::class, 'update'])->name('horses.update')->middleware('role:caretaker');
Route::delete('horses/{horse}', [HorseController::class, 'destroy'])->name('horses.destroy')->middleware('role:caretaker');
Route::delete('/photos/{photo}', [HorsePhotoController::class, 'destroy'])->name('photos.destroy')->middleware('role:caretaker');

/* Race */
Route::get('/race', [RaceController::class, 'index'])->name('race.index')->middleware('role:boss|veterinarian|caretaker');
Route::get('/race/create', [RaceController::class, 'create'])->name('race.create')->middleware('role:caretaker');
Route::post('/race', [RaceController::class, 'store'])->name('race.store')->middleware('role:caretaker');
Route::get('/race/{race}/edit', [RaceController::class, 'edit'])->name('race.edit')->middleware('role:caretaker');
Route::put('/race/{race}', [RaceController::class, 'update'])->name('race.update')->middleware('role:caretaker');
Route::delete('/race/{race}', [RaceController::class, 'destroy'])->name('race.destroy')->middleware('role:caretaker');

/* Expense */
Route::get('/expenses', [ExpenseController::class, 'index'])->name('expenses.index')->middleware('role:boss|caretaker|veterinarian');
Route::get('/expenses/chart', [ExpenseController::class, 'chart'])->name('expenses.chart')->middleware('role:boss|caretaker|veterinarian');
Route::get('/expenses/summary', [ExpenseController::class, 'summary'])->name('expenses.summary')->middleware('role:boss|caretaker|veterinarian');
Route::get('/expenses/summary/pdf', [ExpenseController::class, 'downloadSummaryPdf'])->name('expenses.summary.pdf')->middleware('role:boss|caretaker|veterinarian');


Route::get('/expenses/create', [ExpenseController::class, 'create'])->name('expenses.create')->middleware('role:caretaker');
Route::post('/expenses', [ExpenseController::class, 'store'])->name('expenses.store')->middleware('role:caretaker');
Route::get('/expenses/{expense}', [ExpenseController::class, 'show'])->name('expenses.show')->middleware('role:caretaker');
Route::get('/expenses/{expense}/edit', [ExpenseController::class, 'edit'])->name('expenses.edit')->middleware('role:caretaker');
Route::put('/expenses/{expense}', [ExpenseController::class, 'update'])->name('expenses.update')->middleware('role:caretaker');
Route::delete('/expenses/{expense}', [ExpenseController::class, 'destroy'])->name('expenses.destroy')->middleware('role:caretaker|boss');

/* Roles */
Route::get('/select-role', function () {
    return view('auth.select-role');
})->name('select-role');

Route::get('/register', [RegisteredUserController::class, 'create'])
    ->name('register');

Route::post('/register', [RegisteredUserController::class, 'store']);

/* Caretakers*/

Route::get('/caretakers', [CaretakerController::class, 'index'])->name('caretakers.index');
Route::get('/caretakers/{caretaker}', [CaretakerController::class, 'show'])->name('caretakers.show');
Route::delete('/caretakers/{caretaker}', [CaretakerController::class, 'destroy'])->name('caretakers.destroy');
Route::post('/caretakers/{caretaker}/reassign', [CaretakerController::class, 'reassign'])->name('caretakers.reassign');


/* Roles */


/* Calendar */
Route::get('/calendar', [CalendarEventController::class, 'index'])->name('calendar.index');
Route::get('/calendar/create', [CalendarEventController::class, 'create'])->name('calendar.create');
Route::post('/calendar', [CalendarEventController::class, 'store'])->name('calendar.store');
Route::get('/calendar/{calendarEvent}/edit', [CalendarEventController::class, 'edit'])->name('calendar.edit');
Route::put('/calendar/{calendarEvent}', [CalendarEventController::class, 'update'])->name('calendar.update');
Route::delete('/calendar/{calendarEvent}', [CalendarEventController::class, 'destroy'])->name('calendar.destroy');
require __DIR__ . '/auth.php';

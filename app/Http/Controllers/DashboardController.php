<?php

// app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;

use App\Models\Horse;
use App\Models\Race;
use App\Models\VetVisit;
use App\Models\CalendarEvent;
use App\Models\Expense;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $horsesQuery = Horse::query();
    /** @var \App\Models\User $user */

        if ($user->hasRole('admin')) {
            $horses = $horsesQuery->get();
        } elseif ($user->hasRole('boss')) {
            $horses = $horsesQuery->where('boss_id', $user->id)->get();
        } elseif ($user->hasRole('caretaker')) {
            $horses = $horsesQuery->where('caretaker_id', $user->id)->get();
        } else {
            $horses = collect();
        }

        $horseIds = $horses->pluck('id');

        $nextRaces = Race::whereIn('horse_id', $horseIds)
            ->where('date', '>=', now())
            ->orderBy('date')->get();

        $nextVetVisits = VetVisit::whereIn('horse_id', $horseIds)
            ->where('visit_date', '>=', now())
            ->orderBy('visit_date')->get();

        $nextCalendarEvents = CalendarEvent::whereIn('horse_id', $horseIds)
            ->where('event_date', '>=', now())
            ->orderBy('event_date')->get();

        $events = $nextRaces->map(fn($r) => (object)[
            'horse_id' => $r->horse_id,
            'event_date' => $r->date,
            'title' => $r->name,
            'category' => 'Carrera',
        ])->concat(
            $nextVetVisits->map(fn($v) => (object)[
                'horse_id' => $v->horse_id,
                'event_date' => $v->visit_date,
                'title' => $v->reason,
                'category' => 'Visita Veterinaria',
            ])
        )->concat(
            $nextCalendarEvents->map(fn($e) => (object)[
                'horse_id' => $e->horse_id,
                'event_date' => $e->event_date,
                'title' => $e->title,
                'category' => $e->category,
            ])
        )->sortBy('event_date')->take(5);

        $alerts = $events->filter(fn($e) => $e->event_date <= now()->addDays(7));

        $expenses = Expense::whereIn('horse_id', $horseIds)
            ->selectRaw('horse_id, SUM(amount) as total')
            ->groupBy('horse_id')
            ->get()
            ->keyBy('horse_id');

        return view('dashboard', compact('horses', 'events', 'expenses', 'alerts'));
    }
}

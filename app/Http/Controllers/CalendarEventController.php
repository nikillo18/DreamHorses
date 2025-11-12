<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCalendarEventRequest;
use App\Http\Requests\UpdateCalendarEventRequest;
use App\Models\CalendarEvent;
use App\Models\Horse;
use App\Traits\FiltersByUserRole;
use Illuminate\Support\Facades\Auth;


class CalendarEventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use FiltersByUserRole;
    public function index()
    {
    $events = $this->filterByUserRole(CalendarEvent::with('horse')->latest())->get();
    $horses = $this->getUserHorses();
    return view('calendar.index', compact('events', 'horses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $horse = $this->getUserHorses();

        return view('calendar.create', compact('horse'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCalendarEventRequest $request)
    {
        $validatedData = $request->validated();
        CalendarEvent::create($validatedData);
        return redirect()->route('calendar.index')->with('success', 'Evento Creado con Exito');
    }

    /**
     * Display the specified resource.
     */
    public function show(CalendarEvent $calendarEvent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CalendarEvent $calendarEvent)
    {
        $horse = $this->getUserHorses();
        return view('calendar.edit', compact('calendarEvent', 'horse'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCalendarEventRequest $request, CalendarEvent $calendarEvent)
    {
        $validatedData = $request->validated();
        $calendarEvent->update($validatedData);
        return redirect()->route('calendar.index')->with('success', 'Evento Actualizado con Exito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CalendarEvent $calendarEvent)
    {
        $calendarEvent->delete();
        return redirect()->route('calendar.index')->with('success', 'Evento Eliminado con Exito');
    }
public function calendar()
{
    /** @var \App\Models\User $user */

    $user = Auth::user();

    $query = CalendarEvent::with('horse');

    if ($user->hasRole('caretaker')) {
        $query->whereHas('horse', function ($q) use ($user) {
            $q->where('caretaker_id', $user->id);
        });
    }

    elseif ($user->hasRole('boss')) {
        $query->whereHas('horse', function ($q) use ($user) {
            $q->where('boss_id', $user->id);
        });
    }


    $events = $query->get()->map(function($event) {
        return [
            'title' => $event->category,
            'horse' => $event->horse->name,
            'time' => substr($event->event_time, 0, 5),
            'start' => $event->event_date . 'T' . $event->event_time,
        ];
    });

    return view('calendar.show', compact('events'));
}
}

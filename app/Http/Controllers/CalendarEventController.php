<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCalendarEventRequest;
use App\Http\Requests\UpdateCalendarEventRequest;
use App\Models\CalendarEvent;
use App\Models\Horse;

class CalendarEventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = CalendarEvent::with('horse')->get();
        return view('calendar.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $horse = Horse::all();
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
        $horse = Horse::all();
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
}

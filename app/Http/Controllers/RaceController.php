<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRaceRequest;
use App\Http\Requests\UpdateRaceRequest;
use App\Models\Horse;
use App\Models\Race;

use Illuminate\Http\Request;

use function Pest\Laravel\get;

class RaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Race::with(['horse'])->latest();

        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->whereHas('horse', function ($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%');
            });
        }

        $race = $query->get();

        return view('race.index', compact('race'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $horse = Horse::all();
        return view('race.create', compact('horse'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRaceRequest $request)
    {
        $validatedData = $request->validated();
        Race::create($validatedData);
        return redirect()->route('race.index')->with('success', 'Carrera Creada con Exito ');
    }

    /**
     * Display the specified resource.
     */
    public function show(Race $race)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Race $race)
    {
        $horse = Horse::all();
        return view('race.edit', compact('race', 'horse'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRaceRequest $request, Race $race)
    {
        $validatedData = $request->validated();
        $race->update($validatedData);
        return redirect()->route('race.index')->with('success', 'Carrera Actualizada con Exito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Race $race)
    {
        $race->delete();
        return redirect()->route('race.index')->with('success', 'Carrera Eliminada con Exito');
    }
}

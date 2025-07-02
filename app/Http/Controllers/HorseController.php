<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHorseRequest;
use App\Http\Requests\UpdateHorseRequest;
use App\Models\Horse;
use App\Models\Caretaker;

class HorseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $horses = Horse::all();
        return view('Horse.index', compact('horses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $caretakers = Caretaker::all();
        return view('Horse.create', compact('caretakers'));

    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHorseRequest $request)

    {
   $data = $request->validated();

    if ($request->hasFile('photo')) {
        $data['photo_path'] = $request->file('photo')->store('horses', 'public');
    }

    $horse = Horse::create($data);

    if ($request->hasFile('photos')) {
        foreach ($request->file('photos') as $image) {
            $path = $image->store('horses', 'public');
            $horse->photos()->create(['path' => $path]);
        }
    }

    return redirect()->route('Horseindex')->with('success', 'Caballo creado correctamente con fotos.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Horse $horse)
    {
            return view('Horse.show', compact('horse'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Horse $horse)
{
       $caretakers = Caretaker::all();
    return view('Horse.edit', compact('horse', 'caretakers'));
}

public function update(UpdateHorseRequest $request, Horse $horse)
{
{
    $data = $request->validate([
        'name' => 'required|string|max:100',
        'breed' => 'required|string|max:100',
        'color' => 'required|string|max:50',
        'birth_date' => 'required|date',
        'gender' => 'required|in:male,female',
        'father_name' => 'nullable|string|max:100',
        'mother_name' => 'nullable|string|max:100',
        'caretaker_id' => 'required|exists:caretakers,id',
        'photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Actualizamos los datos del caballo
    $horse->update($data);

    // Si hay nuevas fotos, las subimos
    if ($request->hasFile('photos')) {
        foreach ($request->file('photos') as $image) {
            $path = $image->store('horses', 'public');
            $horse->photos()->create(['path' => $path]);
        }
    }

    return redirect()->route('horses.show', $horse->id)
                     ->with('success', 'Caballo actualizado correctamente');

}
}
public function destroy(Horse $horse)
{
    $horse->delete();
    return redirect()->route('Horseindex')->with('success', 'Caballo eliminado correctamente');
}
}

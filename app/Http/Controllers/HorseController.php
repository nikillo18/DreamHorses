<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHorseRequest;
use App\Http\Requests\UpdateHorseRequest;
use App\Models\Horse;
use App\Models\Caretaker;
use Illuminate\Support\Facades\Storage;

class HorseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $horses = Horse::paginate(6);
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
    $data = $request->validated();

    $horse->update($data);

    if ($request->hasFile('photos')) {
        foreach ($horse->photos as $photo) {
            Storage::disk('public')->delete($photo->path);
            $photo->delete();
        }

        foreach ($request->file('photos') as $image) {
            $path = $image->store('horses', 'public');
            $horse->photos()->create(['path' => $path]);
        }
    }

    return redirect()->route('horses.show', $horse->id)
                     ->with('success', 'Caballo actualizado correctamente');
}

public function destroy(Horse $horse)
{
    $horse->delete();
    return redirect()->route('Horseindex')->with('success', 'Caballo eliminado correctamente');
}
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHorseRequest;
use App\Http\Requests\UpdateHorseRequest;
use App\Models\Horse;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class HorseController extends Controller
{
    /**
     * Display a listing of the resource.
     */

public function index()
{
    /** @var \App\Models\User $user */
    $user = Auth::user();

    if ($user && $user->hasRole('admin')) {
        $horses = Horse::with(['boss', 'caretaker'])->latest()->paginate(6);
    } elseif ($user && ($user->hasRole('boss') || $user->hasRole('caretaker'))) {
        $horses = Horse::with(['boss', 'caretaker'])
            ->when($user->hasRole('boss'), function ($query) use ($user) {
                $query->where('boss_id', $user->id);
            })
            ->when($user->hasRole('caretaker'), function ($query) use ($user) {
                $query->orWhere('caretaker_id', $user->id);
            })
            ->latest()
            ->paginate(6);
    } 

    return view('Horse.index', compact('horses'));
}



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $caretakers = User::role('caretaker')->get();
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
    /** @var \App\Models\User $user */

    $user = Auth::user();

    // 👑 Si es jefe, se asigna como boss
    if ($user->hasRole('boss')) {
        $data['boss_id'] = $user->id;
    }

    // 🧤 Si es cuidador, se asigna como caretaker
    if ($user->hasRole('caretaker')) {
        $data['caretaker_id'] = $user->id;
    }

    // 🧠 Si el jefe selecciona un cuidador en el formulario
    if ($user->hasRole('boss') && $request->filled('caretaker_id')) {
        $data['caretaker_id'] = $request->input('caretaker_id');
    }

    $horse = Horse::create($data);

    if ($request->hasFile('photos')) {
        foreach ($request->file('photos') as $image) {
            $path = $image->store('horses', 'public');
            $horse->photos()->create(['path' => $path]);
        }
    }

    return redirect()->route('Horseindex')->with('success', 'Caballo creado correctamente.');
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
       $users = User::all();
    return view('Horse.edit', compact('horse', 'users'));
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
    foreach ($horse->photos as $photo) {
        Storage::disk('public')->delete($photo->path);
        $photo->delete();
    }
    if ($horse->photo_path ?? false) {
        Storage::disk('public')->delete($horse->photo_path);
    }

    $horse->delete();
    return redirect()->route('Horseindex')->with('success', 'Caballo eliminado correctamente');
}
}
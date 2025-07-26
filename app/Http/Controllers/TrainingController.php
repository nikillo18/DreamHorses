<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTrainingRequest;
use App\Http\Requests\UpdateTrainingRequest;
use App\Models\Horse;
use App\Models\Training;

class TrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $training = Training::with(['horse'])->get();

        return view('training.index', compact('training'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $horse = Horse::all();
        return view('training.create', compact('horse'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTrainingRequest $request)
    {
        $validatedData = $request->validated();

        Training::create($validatedData);

        return redirect()->route('training.index')->with('success', 'Entrenamiento Creado con Exito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Training $training)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Training $training)
    {

        $horse = Horse::all();
        return view('training.edit', compact('training', 'horse'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTrainingRequest $request, Training $training)
    {
        $validatedData = $request->validated();

        $training->update($validatedData);

        return redirect()->route('training.index')->with('success', 'Entrenamiento Actualizado con Exito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Training $training)
    {
        $training->delete();

        return redirect()->route('training.index')->with('success', 'Entrenamiento Eliminado con Exito');
    }
}

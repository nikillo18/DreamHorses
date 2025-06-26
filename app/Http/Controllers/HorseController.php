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
        $validatedData = $request->validated();
        Horse::create($validatedData);
        return redirect()->route('CreateHorse')->with('success', 'Horse created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Horse $horse)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Horse $horse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHorseRequest $request, Horse $horse)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Horse $horse)
    {
        //
    }
}

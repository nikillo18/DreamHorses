<?php

namespace App\Http\Controllers;

use App\Models\Blacksmith;
use App\Http\Requests\StoreBlacksmithRequest;
use App\Http\Requests\UpdateBlacksmithRequest;
use App\Models\Horse;
use Illuminate\Http\Request;

class BlacksmithController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Blacksmith::with('horse');
        $horseId = null;
        if ($request->has('horse_id')) {
            $horseId = $request->input('horse_id');
            $query->where('horse_id', $horseId);
        }
        $blacksmiths = $query->get();
        return view('blacksmiths.index', compact('blacksmiths', 'horseId'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $horse = Horse::all();

        return view('blacksmiths.create', compact('horse'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlacksmithRequest $request)
    {
        $validatedData = $request->validated();

        Blacksmith::create($validatedData);

        return redirect()->route('blacksmiths.index')->with('success', 'Herrada Creada con Exito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blacksmith $blacksmith)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blacksmith $blacksmith)
    {
        $horse = Horse::all();
        return view('blacksmiths.edit', compact('blacksmith', 'horse'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlacksmithRequest $request, Blacksmith $blacksmith)
    {
        $validatedData = $request->validated();
        $blacksmith->update($validatedData);
        return redirect()->route('blacksmiths.index')->with('success', 'Herrada Actualizada con Exito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blacksmith $blacksmith)
    {
        $blacksmith->delete();
        return redirect()->route('blacksmiths.index')->with('success', 'Herrada Eliminada con Exito');
    }
}

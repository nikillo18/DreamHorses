<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVetVisitRequest;
use App\Http\Requests\UpdateVetVisitRequest;
use App\Models\Horse;
use App\Models\VetVisit;
use Illuminate\Http\Request;

class VetVisitController extends Controller
{
 public function index(Request $request)
{
    $query = VetVisit::with('horse')->latest();

    if ($request->has('horse_id')) {
        $query->where('horse_id', $request->input('horse_id'));
    }

    $visits = $query->get();
    return view('vetvisit.index', compact('visits'));
}

    public function create()
    {
        $horses = Horse::all(); // Para el select de caballos
        return view('vetvisit.create', compact('horses'));
    }

    public function store(StoreVetVisitRequest $request)
    {
        VetVisit::create($request->validated());
        return redirect()->route('vet-visits.index')->with('success', 'Visita veterinaria creada correctamente.');
    }

    public function edit(VetVisit $vetVisit)
    {
         $horses = Horse::all();
    return view('vetvisit.edit', compact('vetVisit', 'horses'));
    }

    public function update(UpdateVetVisitRequest $request, VetVisit $vetVisit)
    {
        $vetVisit->update($request->validated());
        return redirect()->route('vet-visits.index')->with('success', 'Visita actualizada correctamente.');
    }

    public function destroy(VetVisit $vetVisit)
    {
        $vetVisit->delete();
        return redirect()->route('vet-visits.index')->with('success', 'Visita eliminada correctamente.');
    }
}

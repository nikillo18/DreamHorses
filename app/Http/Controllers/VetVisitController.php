<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVetVisitRequest;
use App\Http\Requests\UpdateVetVisitRequest;
use App\Models\Horse;
use App\Models\VetVisit;
use Illuminate\Http\Request;
use App\Traits\FiltersByUserRole; 

class VetVisitController extends Controller
{
    use FiltersByUserRole; 

    public function index(Request $request)
    {
        $query = VetVisit::with('horse')->latest();

        $query = $this->filterByUserRole($query);

        $horseId = null;
        if ($request->filled('horse_id')) {
            $horseId = $request->input('horse_id');
            $query->where('horse_id', $horseId);
        }

        $visits = $query->paginate(6);

        return view('vetvisit.index', compact('visits', 'horseId'));
    }

    public function create()
    {
        $horses = $this->getUserHorses();
        return view('vetvisit.create', compact('horses'));
    }

    public function store(StoreVetVisitRequest $request)
    {
        VetVisit::create($request->validated());
        return redirect()->route('vet-visits.index')->with('success', 'Visita veterinaria creada correctamente.');
    }

    public function edit(VetVisit $vetVisit)
    {
        $horses = $this->getUserHorses();
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

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCaretakerRequest;
use App\Http\Requests\UpdateCaretakerRequest;
use App\Models\Caretaker;
use Illuminate\Http\Request;

class CaretakerController extends Controller
{
    public function index()
    {
        $caretakers = Caretaker::all();
        return view('caretakers.index', compact('caretakers'));
    }

    public function show(Caretaker $caretaker)
    {
        $otherCaretakers = Caretaker::where('id', '!=', $caretaker->id)->get();

        return view('caretakers.show', compact('caretaker', 'otherCaretakers'));
    }

    public function destroy(Caretaker $caretaker)
    {
        $caretaker->delete();
        return redirect()->route('caretakers.index')->with('success', 'Cuidador eliminado correctamente.');
    }

    public function reassign(Request $request, Caretaker $caretaker)
    {
        $request->validate([
            'new_caretaker_id' => 'required|exists:caretakers,id'
        ]);

        $caretaker->horses()->update([
            'caretaker_id' => $request->new_caretaker_id
        ]);

        $caretaker->delete();

        return redirect()->route('caretakers.index')->with('success', 'Caballos reasignados y cuidador eliminado.');
    }
}

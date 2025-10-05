<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCaretakerRequest;
use App\Http\Requests\UpdateCaretakerRequest;
use App\Models\Caretaker;
use App\Models\User;
use Illuminate\Http\Request;

class CaretakerController extends Controller
{
    public function index()
    {
        $caretakers = User::role('caretaker')->get();
        return view('caretakers.index', compact('caretakers'));
    }

    public function show(User $caretaker)

    {
         $caretaker->load('horsesCaretaker');
        $otherCaretakers = User::where('id', '!=', $caretaker->id)->get();

        return view('caretakers.show', compact('caretaker', 'otherCaretakers'));
    }

    public function destroy(User $caretaker)
    {
        $caretaker->delete();
        return redirect()->route('caretakers.index')->with('success', 'Cuidador eliminado correctamente.');
    }

    public function reassign(Request $request, User $caretaker)
    {
        $request->validate([
            'new_caretaker_id' => 'required|exists:users,id'
        ]);

        $caretaker->horsesCaretaker()->update([
            'caretaker_id' => $request->new_caretaker_id
        ]);

        $caretaker->delete();

        return redirect()->route('caretakers.index')->with('success', 'Caballos reasignados y cuidador eliminado.');
    }
}

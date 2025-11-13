<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCaretakerRequest;
use App\Http\Requests\UpdateCaretakerRequest;
use App\Models\Caretaker;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CaretakerController extends Controller
{
   public function index()
{
    /** @var \App\Models\User $user */
$user = Auth::user();

        if ($user->hasRole('admin')) {
            $caretakers = User::role('caretaker')->get();
        }
        elseif ($user->hasRole('boss')) {
            $caretakers = User::whereHas('studs', function ($q) use ($user) {
                $q->whereIn('stud_id', $user->acceptedContractedStuds->pluck('id'));
            })
            ->role('caretaker')
            ->get();
        }
        elseif ($user->hasRole('caretaker')) {
            $caretakers = User::whereHas('studs', function ($q) use ($user) {
                $q->whereIn('stud_id', $user->studs->pluck('id'));
            })
            ->where('id', '!=', $user->id)
            ->role('caretaker')
            ->get();
        } else {
            $caretakers = collect(); 
        }

        return view('caretakers.index', compact('caretakers'));
    
}


    public function show(User $caretaker)
{
    /** @var \App\Models\User $user */
    $user = Auth::user();

    // Cargamos los caballos del cuidador actual
    $caretaker->load('horsesCaretaker');

    if ($user->hasRole('boss')) {
        $availableCaretakers = User::whereHas('studs', function ($q) use ($user) {
                $q->whereIn('stud_id', $user->acceptedContractedStuds->pluck('id'));
            })
            ->where('id', '!=', $caretaker->id)
            ->role('caretaker')
            ->get();
    }
    elseif ($user->hasRole('admin')) {
        $availableCaretakers = User::role('caretaker')
            ->where('id', '!=', $caretaker->id)
            ->get();
    }
    else {
        $availableCaretakers = collect();
    }

    return view('caretakers.show', compact('caretaker', 'availableCaretakers'));
}


    public function destroy(User $caretaker)
    {
  
    }

    public function reassign(Request $request, User $caretaker)
   {
    $request->validate([
        'new_caretaker_id' => 'required|exists:users,id'
    ]);

    $caretaker->horsesCaretaker()->update([
        'caretaker_id' => $request->new_caretaker_id
    ]);

    return redirect()->route('caretakers.index')->with('success', 'Caballos reasignados correctamente.');
  }

}

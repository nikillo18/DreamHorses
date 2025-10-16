<?php

namespace App\Http\Controllers;

use App\Models\Stud;
use App\Http\Requests\StoreStudRequest;
use App\Http\Requests\UpdateStudRequest;
use Illuminate\Support\Facades\Auth;
use App\Traits\FiltersByUserRole;
use Illuminate\Http\Request;

class StudController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use FiltersByUserRole;

    public function index()
    {
        $studs = Stud::with('owner')->paginate(10);
        return view('studs.index', compact('studs'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      return view('studs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(StoreStudRequest $request)
{
$data = $request->validated();
    $data['owner_id'] = Auth::id();

    $stud = Stud::create($data);

    // el dueño automáticamente también trabaja ahí
    $stud->caretakers()->attach(Auth::id());

    return redirect()->route('studs.show', $stud)
                     ->with('success', 'Stud creado correctamente.');

}


    /**
     * Display the specified resource.
     */
    public function show(Stud $stud)
    {
    $stud->load('caretakers', 'owner');
        return view('studs.show', compact('stud'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stud $stud)
    {
       if (Auth::id() !== $stud->owner_id) {
        abort(403, 'No puedes editar un stud que no te pertenece.');
    }

    return view('studs.edit', compact('stud'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudRequest $request, Stud $stud)
    {
        if (Auth::id() !== $stud->owner_id) {
        abort(403, 'No puedes editar un stud que no te pertenece.');
    }

    $stud->update($request->validated());

    return redirect()->route('studs.show', $stud)
                     ->with('success', 'Stud actualizado correctamente.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stud $stud)
    {
          $user = Auth::user();
        if ($stud->owner_id != $user->id) {
            abort(403);
        }
        $stud->delete();
        return redirect()->route('studs.index')->with('success', 'Stud eliminado.');
    }
    public function join(Stud $stud)
    {
        $user = Auth::user();
        if (! $stud->caretakers()->where('user_id', $user->id)->exists()) {
            $stud->caretakers()->attach($user->id);
        }
        return back()->with('success', 'Te uniste al stud.');
    }

    public function leave(Stud $stud)
    {
        $user = Auth::user();
    
        if ($stud->owner_id == $user->id) {
            return back()->with('error', 'El dueño no puede renunciar. Transferí o eliminá el stud.');
        }
        $stud->caretakers()->detach($user->id);
        return back()->with('success', 'Renunciaste del stud.');
    }

    public function kick(Request $request, Stud $stud)
    {
        $user = Auth::user();
        if ($stud->owner_id != $user->id) {
            abort(403);
        }

        $request->validate([
            'caretaker_id' => 'required|exists:users,id',
        ]);

        $stud->caretakers()->detach($request->caretaker_id);
        return back()->with('success', 'Cuidador despedido.');
    }
    public function hire(Stud $stud)
{
        /** @var \App\Models\User $user */

    $user = Auth::user();
    if (! $user->hasRole('boss')) abort(403);

    if (! $user->contractedStuds()->where('stud_id', $stud->id)->exists()) {
        $user->contractedStuds()->attach($stud->id);
    }

    return back()->with('success', 'Has contratado este stud.');
}

public function fire(Stud $stud)
{
        /** @var \App\Models\User $user */

    $user = Auth::user();
    if (! $user->hasRole('boss')) abort(403);

    $user->contractedStuds()->detach($stud->id);

    return back()->with('success', 'Has dejado de contratar este stud.');
}


}

<?php

namespace App\Http\Controllers;

use App\Models\HorsePhoto;
use App\Http\Requests\StoreHorsePhotoRequest;
use App\Http\Requests\UpdateHorsePhotoRequest;
use Illuminate\Support\Facades\Storage;


class HorsePhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHorsePhotoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(HorsePhoto $horsePhoto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HorsePhoto $horsePhoto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHorsePhotoRequest $request, HorsePhoto $horsePhoto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HorsePhoto $photo)
    {
        // Check if the photo exists
        if (!$photo) {
            return redirect()->back()->with('error', 'Photo not found.');
        }

        // Delete the photo file from storage
        Storage::disk('public')->delete($photo->path);

        // Delete the photo record from the database
        $photo->delete();

        return redirect()->route('Horseindex')->with('success', 'Photo deleted successfully.');
    }
    
}

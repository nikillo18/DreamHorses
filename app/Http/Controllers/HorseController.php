<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHorseRequest;
use App\Http\Requests\UpdateHorseRequest;
use App\Models\Horse;

class HorseController extends Controller
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
    public function store(StoreHorseRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Horse $horse)
    {
        //
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

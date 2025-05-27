<?php

namespace App\Http\Controllers;

use App\Models\ExtraEquipment;
use Illuminate\Http\Request;

class ExtraEquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $equipment = ExtraEquipment::all();
        return view('admin.equipment.index', compact('equipment'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.equipment.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price_per_day' => 'required|numeric|min:0',
        ]);

        ExtraEquipment::create($validated);

        return redirect()->route('admin.equipment.index')->with('success', 'Oprema je dodata.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ExtraEquipment $quipment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ExtraEquipment $equipment)
    {
        return view('admin.equipment.edit', compact('equipment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ExtraEquipment $quipment)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price_per_day' => 'required|numeric|min:0',
        ]);

        $quipment->update($validated);

        return redirect()->route('admin.equipment.index')->with('success', 'Oprema je ažurirana.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExtraEquipment $equipment)
    {
        return redirect()->route('admin.equipment.index')->with('success', 'Oprema je obrisana.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\ExtraEquipment;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = Car::all();
        return view('admin.cars.index', compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.cars.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'brand' => 'required|string',
            'model' => 'required|string',
            'year' => 'required|digits:4|integer',
            'price_per_day' => 'required|numeric',
            'transmission' => 'required|in:Manuelni,Automatski',
            'fuel' => 'required|in:Benzin,Dizel,Elektricni,Hibrid',
            'category' => 'required|in:Malo vozilo,Srednje vozilo,Veliko vozilo',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        // Manually set checkbox value
        $validated['featured'] = $request->has('featured');

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('uploads/cars', 'public');
        }

        Car::create($validated);

        return redirect()->route('admin.cars.index')->with('success', 'Vozilo je uspešno dodato.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        $equipment = ExtraEquipment::all();

        return view('car-details', compact('car', 'equipment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        return view('admin.cars.edit', compact('car'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {
        $validated = $request->validate([
            'brand' => 'required|string',
            'model' => 'required|string',
            'year' => 'required|digits:4|integer',
            'price_per_day' => 'required|numeric',
            'transmission' => 'required|in:Manuelni,Automatski',
            'fuel' => 'required|in:Benzin,Dizel,Elektricni,Hibrid',
            'category' => 'required|in:Malo vozilo,Srednje vozilo,Veliko vozilo',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        // Manually set checkbox value
        $validated['featured'] = $request->has('featured');

        // Handle image replacement
        if ($request->hasFile('image')) {
            if ($car->image) {
                Storage::disk('public')->delete($car->image);
            }
            $validated['image'] = $request->file('image')->store('uploads/cars', 'public');
        }

        $car->update($validated);

        return redirect()->route('admin.cars.index')->with('success', 'Vozilo je uspešno izmenjeno.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        if ($car->image) {
            Storage::disk('public')->delete($car->image);
        }

        $car->delete();

        return redirect()->route('admin.cars.index')->with('success', 'Vozilo je uspešno obrisano.');
    }
}

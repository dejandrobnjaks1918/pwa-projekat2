<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\Car;
use App\Models\User;
use App\Models\ExtraEquipment;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RentalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rentals = Rental::with('user', 'car')->orderBy('start_date', 'desc')->get();
        return view('admin.rentals.index', compact('rentals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::where('role', 'user')->get();
        $cars = Car::all();
        $allEquipment = ExtraEquipment::all();

        return view('admin.rentals.create', compact('users', 'cars', 'allEquipment'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
        'user_id' => 'required|exists:users,id',
        'car_id' => 'required|exists:cars,id',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
    ]);

    $car = Car::findOrFail($validated['car_id']);
    $equipmentIds = $request->input('equipment', []);
    $equipmentItems = ExtraEquipment::whereIn('id', $equipmentIds)->get();

    // Izračunavanje broja dana
    $start = Carbon::parse($validated['start_date']);
    $end = Carbon::parse($validated['end_date']);
    $days = $start->diffInDays($end) + 1;

    // Osnovna cena
    $carCost = $car->price_per_day * $days;

    // Cena opreme
    $equipmentCost = $equipmentItems->sum(function ($item) use ($days) {
        return $item->price_per_day * $days;
    });

    $validated['total_price'] = $carCost + $equipmentCost;

    $rental = Rental::create($validated);
    $rental->equipment()->sync($equipmentIds);

    return redirect()->route('admin.rentals.index')->with('success', 'Najam je uspešno dodat sa ukupnom cenom.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Rental $rental)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rental $rental)
    {
         $users = User::where('role', 'user')->get();
        $cars = Car::all();
        $allEquipment = ExtraEquipment::all();

        return view('admin.rentals.edit', compact('rental', 'users', 'cars', 'allEquipment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rental $rental)
    {
        $validated = $request->validate([
        'user_id' => 'required|exists:users,id',
        'car_id' => 'required|exists:cars,id',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
    ]);

    $car = Car::findOrFail($validated['car_id']);
    $equipmentIds = $request->input('equipment', []);
    $equipmentItems = ExtraEquipment::whereIn('id', $equipmentIds)->get();

    $start = Carbon::parse($validated['start_date']);
    $end = Carbon::parse($validated['end_date']);
    $days = $start->diffInDays($end) + 1;

    $carCost = $car->price_per_day * $days;

    $equipmentCost = $equipmentItems->sum(function ($item) use ($days) {
        return $item->price_per_day * $days;
    });

    $validated['total_price'] = $carCost + $equipmentCost;

    $rental->update($validated);
    $rental->equipment()->sync($equipmentIds);

    return redirect()->route('admin.rentals.index')->with('success', 'Najam je ažuriran sa novom ukupnom cenom.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rental $rental)
    {
        $rental->equipment()->detach();
        $rental->delete();

        return redirect()->route('admin.rentals.index')->with('success', 'Najam je obrisan.');
    }
}

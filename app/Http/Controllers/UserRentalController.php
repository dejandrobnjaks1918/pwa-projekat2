<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\Car;
use App\Models\ExtraEquipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class UserRentalController extends Controller
{
    public function index()
    {
        $rentals = Rental::with('car', 'equipment')
            ->where('user_id', Auth::id())
            ->orderByDesc('start_date')
            ->get();

        return view('user.rentals.index', compact('rentals'));
    }

    public function create(Car $car)
    {
        $equipment = ExtraEquipment::all();
        return view('user.rentals.create', compact('car', 'equipment'));
    }

    public function store(Request $request, Car $car)
    {
        $validated = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $equipmentIds = $request->input('equipment', []);
        $equipmentItems = ExtraEquipment::whereIn('id', $equipmentIds)->get();

        $days = Carbon::parse($validated['start_date'])->diffInDays(Carbon::parse($validated['end_date'])) + 1;
        $carCost = $car->price_per_day * $days;
        $equipmentCost = 0;
        foreach ($equipmentItems as $item) {
            $equipmentCost += $item->price_per_day * $days;
        }

        $rental = Rental::create([
            'user_id' => Auth::id(),
            'car_id' => $car->id,
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'total_price' => $carCost + $equipmentCost,
        ]);

        $rental->equipment()->sync($equipmentIds);

        return redirect()->route('user.rentals.index')->with('success', 'Rezervacija je uspešno kreirana!');
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Rental;
use App\Models\Car;
use App\Models\User;
use Carbon\Carbon;


class RentalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('role', 'user')->first();
        $car = Car::first();

        if (!$user || !$car) {
            echo "Nema korisnika ili automobila u bazi";
            return;
        }

        for ($i = 0; $i < 5; $i++) {
            $start = Carbon::now()->addDays($i * 2);
            $end = $start->copy()->addDays(rand(2, 5));
            $days = $start->diffInDays($end) + 1;

            $price = $car->price_per_day * $days;

            Rental::create([
                'user_id' => $user->id,
                'car_id' => $car->id,
                'start_date' => $start->format('Y-m-d'),
                'end_date' => $end->format('Y-m-d'),
                'total_price' => $price,
            ]);
        }
    }
}

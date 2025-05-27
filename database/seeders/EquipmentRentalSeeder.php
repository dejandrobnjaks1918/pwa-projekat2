<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Rental;
use App\Models\ExtraEquipment;
use Illuminate\Support\Facades\DB;

class EquipmentRentalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $equipmentIds = ExtraEquipment::pluck('id')->toArray();

        Rental::all()->each(function ($rental) use ($equipmentIds) {
            $randomEquipment = collect($equipmentIds)->random(rand(1, 3))->all();
            foreach ($randomEquipment as $equipmentId) {
                DB::table('equipment_rental')->insert([
                    'rental_id' => $rental->id,
                    'extra_equipment_id' => $equipmentId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        });
    }
}

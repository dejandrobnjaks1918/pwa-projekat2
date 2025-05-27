<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ExtraEquipment;

class ExtraEquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ExtraEquipment::insert([
            [
                'name' => 'Dečije sedište',
                'description' => 'Pogodno za decu do 12 godina starosti.',
                'price_per_day' => 5.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'GPS navigacija',
                'description' => 'Moderni GPS uređaj sa ažuriranim mapama.',
                'price_per_day' => 4.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dodatno osiguranje',
                'description' => 'Pokriva štetu u slučaju nezgode.',
                'price_per_day' => 8.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Lanac za sneg',
                'description' => 'Obavezan u zimskim uslovima.',
                'price_per_day' => 3.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Wi-Fi hotspot uređaj',
                'description' => 'Pruža mobilni internet tokom putovanja.',
                'price_per_day' => 6.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

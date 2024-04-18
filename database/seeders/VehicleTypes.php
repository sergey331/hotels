<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VehicleTypes extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $titles = [
            'Truck',
            'Straight Truck',
            'Cargo Van',
            'Sprinter',
            'Pickup Truck',
            'Car',
            'Cube Van',
        ];

        foreach ($titles as $title) {
            DB::table('vehicle_types')->insert([
                'name' => $title,
            ]);
        }
    }
}

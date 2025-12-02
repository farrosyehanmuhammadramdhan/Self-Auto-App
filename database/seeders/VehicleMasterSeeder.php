<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\VehicleMaster;

class VehicleMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vehicles = [
            [
                'brand' => 'Toyota', 
                'model' => 'Avanza', 
                'year' => 2020, 
                'type' => 'MPV', 
                'wheels' => '4',
            ],

            [
                'brand' => 'Honda',  
                'model' => 'Brio', 
                'year' => 2021, 
                'type' => 'Hatchback', 
                'wheels' => '4',
            ],

            [
                'brand' => 'Mitsubishi', 
                'model' => 'Xpander', 
                'year' => 2019, 
                'type' => 'MPV', 
                'wheels' => '4',
            ],

            [
                'brand' => 'Suzuki', 
                'model' => 'Ertiga', 
                'year' => 2020, 
                'type' => 'MPV', 
                'wheels' => '4',
            ],

            [
                'brand' => 'Daihatsu', 
                'model' => 'Xenia', 
                'year' => 2021, 
                'type' => 'MPV', 
                'wheels' => '4',
            ],

            [
                'brand' => 'Honda', 
                'model' => 'HR-V', 
                'year' => 2020, 
                'type' => 'SUV', 
                'wheels' => '4',
            ],

            [
                'brand' => 'Toyota', 
                'model' => 'Fortuner', 
                'year' => 2021, 
                'type' => 'SUV', 
                'wheels' => '4',
            ],

            [
                'brand' => 'Mitsubishi', 
                'model' => 'Pajero Sport', 
                'year' => 2020, 
                'type' => 'SUV', 
                'wheels' => '4',
            ],

            [
                'brand' => 'Toyota', 
                'model' => 'Kijang Innova', 
                'year' => 2019, 
                'type' => 'MPV', 
                'wheels' => '4',
            ],

            [
                'brand' => 'Honda', 
                'model' => 'Jazz', 
                'year' => 2020, 
                'type' => 'Hatchback', 
                'wheels' => '4',
            ],
        ];

        foreach ($vehicles as $vehicle) {
            VehicleMaster::create($vehicle);
        }
    }
}

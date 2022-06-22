<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Vehicle::create([
            'type_id' => 1,
            'brand_id' => 2,
            'color_id' => 3,
            'customer_id' => 3,
            'license_plate' => 'WHC-212',
            'model_year' => 2020,
        ]);

    }
}

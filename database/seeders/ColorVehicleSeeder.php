<?php

namespace Database\Seeders;

use App\Models\ColorVehicle;
use Illuminate\Database\Seeder;

class ColorVehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ColorVehicle::factory(10)->create();
    }
}

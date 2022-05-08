<?php

namespace Database\Seeders;

use App\Models\TypeVehicle;
use Illuminate\Database\Seeder;

class TypeVehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypeVehicle::factory()->create([
            'type_vehicle' => 'camioneta'//1
        ]);
        TypeVehicle::factory()->create([
            'type_vehicle' => 'minivan'//2
        ]);
        TypeVehicle::factory()->create([
            'type_vehicle' => 'sedan'//3
        ]);
        TypeVehicle::factory()->create([
            'type_vehicle' => 'deportivo'//4
        ]);
        TypeVehicle::factory()->create([
            'type_vehicle' => 'van'//5
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\BrandVehicle;
use Illuminate\Database\Seeder;

class BrandVehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        BrandVehicle::factory(10)->create();
//        BrandVehicle::factory()->create([
//            'brand_vehicle' => 'suzuki',
//            'type_vehicle_id' => 2,
//        ]);
//        BrandVehicle::factory()->create([
//            'brand_vehicle' => 'suzuki',
//            'type_vehicle_id' => 3,
//        ]);
//        BrandVehicle::factory()->create([
//            'brand_vehicle' => 'suzuki',
//            'type_vehicle_id' => 4,
//        ]);
//        BrandVehicle::factory()->create([
//            'brand_vehicle' => 'suzuki',
//            'type_vehicle_id' => 5,
//        ]);
//        BrandVehicle::factory()->create([
//            'brand_vehicle' => 'toyota',
//            'type_vehicle_id' => 1,
//        ]);
//        BrandVehicle::factory()->create([
//            'brand_vehicle' => 'toyota',
//            'type_vehicle_id' => 2,
//        ]);
//        BrandVehicle::factory()->create([
//            'brand_vehicle' => 'toyota',
//            'type_vehicle_id' => 3,
//        ]);
//        BrandVehicle::factory()->create([
//            'brand_vehicle' => 'toyota',
//            'type_vehicle_id' => 4,
//        ]);
//        BrandVehicle::factory()->create([
//            'brand_vehicle' => 'nissan',
//            'type_vehicle_id' => 1,
//        ]);
//        BrandVehicle::factory()->create([
//            'brand_vehicle' => 'nissan',
//            'type_vehicle_id' => 4,
//        ]);
//        BrandVehicle::factory()->create([
//            'brand_vehicle' => 'nissan',
//            'type_vehicle_id' => 5,
//        ]);
//        BrandVehicle::factory()->create([
//            'brand_vehicle' => 'kia',
//            'type_vehicle_id' => 1,
//        ]);
//        BrandVehicle::factory()->create([
//            'brand_vehicle' => 'kia',
//            'type_vehicle_id' => 3,
//        ]);
//        BrandVehicle::factory()->create([
//            'brand_vehicle' => 'kia',
//            'type_vehicle_id' => 2,
//        ]);
//        BrandVehicle::factory()->create([
//            'brand_vehicle' => 'hyundai',
//            'type_vehicle_id' => 4,
//        ]);
//        BrandVehicle::factory()->create([
//            'brand_vehicle' => 'hyundai',
//            'type_vehicle_id' => 5,
//        ]);
//        BrandVehicle::factory()->create([
//            'brand_vehicle' => 'honda',
//            'type_vehicle_id' => 3,
//        ]);
//        BrandVehicle::factory()->create([
//            'brand_vehicle' => 'honda',
//            'type_vehicle_id' => 2,
//        ]);
//        BrandVehicle::factory()->create([
//            'brand_vehicle' => 'honda',
//            'type_vehicle_id' => 1,
//        ]);
//        BrandVehicle::factory()->create([
//            'brand_vehicle' => 'chevrolet',
//            'type_vehicle_id' => 1,
//        ]);
//        BrandVehicle::factory()->create([
//            'brand_vehicle' => 'chevrolet',
//            'type_vehicle_id' => 5,
//        ]);
//        BrandVehicle::factory()->create([
//            'brand_vehicle' => 'chevrolet',
//            'type_vehicle_id' => 2,
//        ]);
    }
}

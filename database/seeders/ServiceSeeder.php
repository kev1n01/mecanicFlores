<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Service::create([
            'card_service' => 'J001',
            'category_id' => 1,
            'user_id' => 2,
            'vehicle_id' => 3,
        ]);
    }
}

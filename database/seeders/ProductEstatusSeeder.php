<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductEstatus;
use App\Models\UserEstatus;
use Illuminate\Database\Seeder;

class ProductEstatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        ProductEstatus::factory()->create([
            'name' => 'active'
        ]);
        ProductEstatus::factory()->create([
            'name' => 'inactive'
        ]);
    }
}

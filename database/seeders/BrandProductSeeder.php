<?php

namespace Database\Seeders;

use App\Models\BrandProduct;
use Illuminate\Database\Seeder;

class BrandProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BrandProduct::factory(3)->create();

    }
}

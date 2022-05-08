<?php

namespace Database\Seeders;

use App\Models\SaleEstatus;
use Illuminate\Database\Seeder;

class SaleEstatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SaleEstatus::factory()->create([
            'name' => 'pagada'
        ]);
        SaleEstatus::factory()->create([
            'name' => 'pendiente',
        ]);
        SaleEstatus::factory()->create([
            'name' => 'cancelada',
        ]);
    }
}

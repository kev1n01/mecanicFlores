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
        SaleEstatus::create([
            'name' => 'pagada'
        ]);
        SaleEstatus::create([
            'name' => 'pendiente',
        ]);
        SaleEstatus::create([
            'name' => 'cancelada',
        ]);
    }
}

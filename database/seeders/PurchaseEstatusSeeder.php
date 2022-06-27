<?php

namespace Database\Seeders;

use App\Models\PurchaseEstatus;
use Illuminate\Database\Seeder;

class PurchaseEstatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PurchaseEstatus::create([
            'name' => 'nueva'
        ]);
        PurchaseEstatus::create([
            'name' => 'aprobada',
        ]);
        PurchaseEstatus::create([
            'name' => 'restrasada',
        ]);
        PurchaseEstatus::create([
            'name' => 'recibida',
        ]);
        PurchaseEstatus::create([
            'name' => 'anulada',
        ]);
    }
}

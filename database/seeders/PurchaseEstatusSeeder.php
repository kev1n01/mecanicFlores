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
        PurchaseEstatus::factory()->create([
            'name' => 'nueva'
        ]);
        PurchaseEstatus::factory()->create([
            'name' => 'aprobada',
        ]);
        PurchaseEstatus::factory()->create([
            'name' => 'restrasada',
        ]);
        PurchaseEstatus::factory()->create([
            'name' => 'recibida',
        ]);
        PurchaseEstatus::factory()->create([
            'name' => 'anulada',
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\ProviderEstatus;
use Illuminate\Database\Seeder;

class ProviderEstatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProviderEstatus::factory()->create([
            'name' => 'active'
        ]);
        ProviderEstatus::factory()->create([
            'name' => 'inactive'
        ]);

    }
}

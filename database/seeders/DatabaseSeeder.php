<?php

namespace Database\Seeders;

use App\Models\Purchase;
use App\Models\PurchaseEstatus;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserEstatusSeeder::class);
        $this->call(ProductEstatusSeeder::class);
        $this->call(CategoryProductSeeder::class);
        $this->call(BrandProductSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        \App\Models\User::factory(3)->create();
        $this->call(ProviderSeeder::class);
        $this->call(ProviderEstatusSeeder::class);
//        $this->call(PurchaseSeeder::class);
        $this->call(PurchaseEstatusSeeder::class);
        $this->call(SaleEstatusSeeder::class);
        $this->call(DenominationSeeder::class);
    }
}


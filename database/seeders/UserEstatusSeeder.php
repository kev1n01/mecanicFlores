<?php

namespace Database\Seeders;

use App\Models\UserEstatus;
use Illuminate\Database\Seeder;

class UserEstatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserEstatus::factory(2)->create();
    }
}

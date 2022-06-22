<?php

namespace Database\Seeders;

use App\Models\CategoryService;
use Illuminate\Database\Seeder;

class CategoryServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CategoryService::create([
            'name_category' => 'Bajada de motor',
        ]);
        CategoryService::create([
            'name_category' => 'Engrase de palier',
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'administrador',
            'email' => 'admin@gmail.com',
            'password' => bcrypt(12345678),
            'user_status_id' => 1
        ])->assignRole('administrador');

        User::factory()->create([
            'name' => 'cliente',
            'email' => 'cliente@gmail.com',
            'password' => bcrypt(12345678),
            'user_status_id' => 1
        ])->assignRole('cliente');

        User::factory()->create([
            'name' => 'vendedor',
            'email' => 'vendedor@gmail.com',
            'password' => bcrypt(12345678),
            'user_status_id' => 1
        ])->assignRole('vendedor');
    }
}

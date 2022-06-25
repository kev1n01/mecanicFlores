<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $admin = Role::create(['name' => 'administrador']);
        $customer = Role::create(['name' => 'cliente']);
//        $employeer = Role::create(['name' => 'empleado']);
        $seller = Role::create(['name' => 'vendedor']);
        $role = Role::create(['name' => 'role']);

        $permisssions = [
            'create',
            'read',
            'update',
            'delete',
        ];

        foreach (Role::all() as $rol){
            foreach ($permisssions as $p){
                if($rol->name == 'administrador') $rol->name = 'usuario';
                Permission::create(['name' => "{$rol->name} $p"]);
            }
        }

        $admin->syncPermissions(Permission::all());
        $customer->syncPermissions(Permission::where('name','like',"%cliente%")->get());
//        $employeer->syncPermissions(Permission::where('name','like',"%empleado%")->get());
        $seller->syncPermissions(Permission::where('name','like',"%vendedor%")->get());
        $role->syncPermissions(Permission::where('name','like',"%role%")->get());


    }
}

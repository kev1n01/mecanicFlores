<?php

namespace App\Http\Livewire\Admin\Role;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class LiveRoleTable extends Component
{
    protected $listeners = ['rolListUpdate' => 'render'];

    public function render()
    {
        $roles = Role::all(); 
        
        $roles = $roles->each(function($role){
            $role->count_user = User::role($role->name)->count();
        });
    
        $permisos = Permission::all(); 
        $permisos = $permisos->each(function($p){
            $p->count_user = User::permission($p->name)->count();
        });
        
        return view('livewire.admin.role.live-role-table',compact('roles','permisos'))
        ->extends('layouts.admin.app')->section('content');
    }

    public function deleteRole(Role $role){
        $role->delete();
        $this->render();
        $this->emit('successful_alert','Rol eliminado');
    }

    public function deletePermiso(Permission $permiso){
        $permiso->delete();
        $this->render();
        $this->emit('updateModalPermission');
        $this->emit('successful_alert','Permiso eliminado');
    }
}

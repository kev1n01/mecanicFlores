<?php

namespace App\Http\Livewire\Admin\Modal\Role;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ModalPermission extends Component
{
    
    public $classModalDialog = '';
    public $classSize= '';
    public $idModal= 'PermissionModal';
    public $nameComponent = 'Permisos registrados';
    public $action = '';
    public $model;
    public $permission_check = [];

    protected $listeners = [
        'addPermission',
        'updateModalPermission' => 'render',
    ];
    public function render()
    {
        return view('livewire.admin.modal.role.modal-permission');
    }
    public function cerrarModal(){
        $this->dispatchBrowserEvent('close-modal-permission');
    }
    
    public function addPermission($model_id, $model = null){
        $permissions = Permission::all();
        if(!$model){
            $role = Role::find($model_id);
            $this->model = $role;
            $havePermission = $role->permissions()->get();
            foreach($permissions as $permission) {
                if($havePermission->contains($permission)){
                    $this->permission_check[$permission->name]['check'] = true;
                }else{
                    $this->permission_check[$permission->name]['check'] = false; 
                }
                $this->permission_check[$permission->name]['id'] = $permission->id; 
            }
        }else{
            $user = User::find($model_id);
            $this->model = $user;
            $havePermission = $user->getPermissionsViaRoles();
            foreach($permissions as $p) {
                if($user->hasPermissionTo($p)){
                    $this->permission_check[$p->name]['check'] = true;
                }else{
                    $this->permission_check[$p->name]['check'] = false; 
                }
                $this->permission_check[$p->name]['id'] = $p->id; 
            }
            // // dd($this->permission_check);
        }

        $this->dispatchBrowserEvent('open-modal-permission');

    }

    public function addPermissionKey($permission){

        if(!$this->model->hasPermissionTo($permission)){
            $this->model->givePermissionTo($permission);
            $this->emit('successful_alert','permiso agregado al rol');
        }else{
            $this->model->revokePermissionTo($permission);
            $this->emit('successful_alert','permiso revocado al rol');
        }
        $this->emit('rolListUpdate');
    }
    

}

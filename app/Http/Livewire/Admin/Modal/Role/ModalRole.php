<?php

namespace App\Http\Livewire\Admin\Modal\Role;

use App\Http\Requests\RequestCreateRole;
use App\Http\Requests\RequestUpdateRole;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class ModalRole extends Component
{
    public $classModalDialog = 'modal-dialog-centered';
    public $classSize= 'modal-sm';
    public $idModal= 'RoleModal';
    public $method = '';
    public $action = '';
    public $nameComponent = 'Roles';

    public $target;
    public $role = '';
    public $roles = [];
    
    protected $listeners = [
        'toogleModal',
    ];
   
    public function mount(){
        $this->roles = Role::all();
    } 

    public function render()
    {
        return view('livewire.admin.modal.role.modal-role');
    }
    
    public function submit(){
        if($this->method == 'updateTarget'){
            $this->updateTarget();
        }else{
            $this->createTarget();
        }
    }

    public function cerrarModal(){
        $this->resetValidation();  
        $this->resetErrorBag();  
        $this->role = '';
        $this->dispatchBrowserEvent('close-modal');
    }
    
    public function toogleModal($model_id = null,$model= null){
        if($model_id && $model){
            $this->target = $model == 'Role' ? Role::find($model_id) : '';
            $this->role = $this->target->name;
            $this->action = 'Actualizar';
            $this->method = 'updateTarget';
        }else{
            $this->action = 'Registrar';
            $this->method = 'createTarget';
        }

        $this->dispatchBrowserEvent('open-modal');
    }

    public function updateTarget(){
        $request = new RequestUpdateRole();
        $values = $this->validate($request->rules(), $request->messages());
        $this->target->update([
            'name' => $values['role'],
        ]);
        $this->emit('rolListUpdate');
        $this->cerrarModal(); 
        $this->emit('successful_alert','Rol actualizado correctamente');
        
    }
    
    public function createTarget(){
        $request = new RequestCreateRole();
        $values = $this->validate($request->rules(), $request->messages());

        Role::create([
            'name' => $values['role'],
            'guard_name' => 'web',
        ]);
        $this->emit('rolListUpdate');
        $this->cerrarModal(); 
        $this->emit('successful_alert','Rol creado correctamente');
    }
    
    public function updated($label){
        $request = new RequestUpdateRole();   
        $this->validateOnly($label, $request->rules(), $request->messages());        
    }

}

<?php

namespace App\Http\Livewire\Admin\Modal\Status;

use App\Models\ProductEstatus;
use Livewire\Component;

class ModalStatus extends Component
{
    protected $paginationTheme = 'bootstrap';
    public $classModalDialog = 'modal-fullscreen-sm-down';
    public $classSize= 'modal-dialog-scrollable';
    public $idModal= 'StatusModal';
    public $method = '';
    public $action = '';
    public $nameComponent = 'Registro para estados de productos';

    public $name = '';
    public $name_update = '';
    public $target;
    public $active_status_add = false;
    public $active_status_update = false;

    protected $listeners = ['toogleModalStatus','delstatusproduct' => 'deleteStatus'];

    public function render()
    {
        $status = ProductEstatus::all();
        return view('livewire.admin.modal.status.modal-status',compact('status'));
    }
    public function toogleModalStatus(){
        $this->clean();
        $this->resetValidation();
        $this->resetErrorBag();
        $this->method = 'createStatus';
        $this->dispatchBrowserEvent('open-modal-status');
    }

    public function editStatus(){
        $this->target->update(['name' => $this->name_update]);
        $this->clean() ;
        $this->emit('filterUpdate');
        $this->emit('successful_alert', 'El estado '. $this->target->name .' fue actualizado a '. $this->name_update);
    }
    public function addStatus(){
        $category = new ProductEstatus();
        $category->name = $this->name;
        $category->save();
        $this->clean() ;
        $this->emit('filterUpdate');
        $this->emit('successful_alert', 'El estado '. $category->name .' fue creado');
    }
    public function cancelAddStatus(){
        $this->clean() ;
    }
    public function activeAddStatus(){
        $this->active_status_add = true;
    }
    public function activeUpdateStatus($id){
        $this->active_status_update = true;
        $this->target = ProductEstatus::find($id);
        $this->name_update = $this->target->name;
    }
    public function clean(){
        $this->name = '';
        $this->name_update = '';
        $this->active_status_add = false;
        $this->active_status_update = false;
    }
    public function cerrarModal(){
        $this->dispatchBrowserEvent('close-modal-status');
    }
    public function deleteStatus(ProductEstatus $status){
        $status->delete();
        $this->render();
        $this->emit('filterUpdate');
        $this->emit('successful_alert', 'El estado '. $status->name .' fue eliminado');
    }
}

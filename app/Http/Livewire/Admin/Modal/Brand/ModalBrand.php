<?php

namespace App\Http\Livewire\Admin\Modal\Brand;

use App\Models\BrandProduct;
use Livewire\Component;

class ModalBrand extends Component
{
    protected $paginationTheme = 'bootstrap';
    public $classModalDialog = 'modal-fullscreen-sm-down';
    public $classSize= 'modal-dialog-scrollable';
    public $idModal= 'BrandModal';
    public $method = '';
    public $action = '';
    public $nameComponent = 'Registro para marcas de productos';

    public $name = '';
    public $name_update = '';
    public $target;
    public $active_brand_add = false;
    public $active_brand_update = false;

    protected $listeners = ['toogleModalBrand'];

    public function render()
    {
        $brands = BrandProduct::all();
        return view('livewire.admin.modal.brand.modal-brand',compact('brands'));
    }
    public function toogleModalBrand(){
        $this->clean();
        $this->resetValidation();
        $this->resetErrorBag();
        $this->method = 'createBrand';
        $this->dispatchBrowserEvent('open-modal-brand');
    }

    public function editBrand(){
        $this->target->update(['name' => $this->name_update]);
        $this->clean() ;
        $this->emit('filterUpdate');
        $this->emit('successful_alert', 'La marca '. $this->target->name .' fue actualizado a '. $this->name_update);
    }
    public function addBrand(){
        $brand = new BrandProduct();
        $brand->name = $this->name;
        $brand->save();
        $this->clean() ;
        $this->emit('filterUpdate');
        $this->emit('successful_alert', 'La marca '. $brand->name .' fue creado');
    }
    public function cancelAddBrand(){
        $this->clean() ;
    }
    public function activeAddBrands(){
        $this->active_brand_add = true;
    }
    public function activeUpdateBrands($id){
        $this->active_brand_update = true;
        $this->target = BrandProduct::find($id);
        $this->name_update = $this->target->name;
    }
    public function clean(){
        $this->name = '';
        $this->name_update = '';
        $this->active_brand_add = false;
        $this->active_brand_update = false;
    }
    public function cerrarModal(){
        $this->dispatchBrowserEvent('close-modal-brand');
    }
    public function deleteBrand(BrandProduct $brand){
        $brand->delete();
        $this->render();
        $this->emit('filterUpdate');
        $this->emit('successful_alert', 'La marca '. $brand->name .' fue eliminado');
    }
}

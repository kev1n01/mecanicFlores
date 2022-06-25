<?php

namespace App\Http\Livewire\Admin\Modal\Category;

use App\Models\CategoryProduct;
use Livewire\Component;

class ModalCategory extends Component
{
    protected $paginationTheme = 'bootstrap';
    public $classModalDialog = 'modal-fullscreen-sm-down';
    public $classSize= 'modal-dialog-scrollable';
    public $idModal= 'CategoryModal';
    public $method = '';
    public $action = '';
    public $nameComponent = 'Registro para categorias de productos';

    public $name = '';
    public $name_update = '';
    public $target;
    public $active_category_add = false;
    public $active_category_update = false;

    protected $listeners = ['toogleModalCategory','deleteCategory'];

    public function render()
    {
        $categories = CategoryProduct::all();
        return view('livewire.admin.modal.category.modal-category',compact('categories'));
    }
    public function toogleModalCategory(){
        $this->clean();
        $this->resetValidation();
        $this->resetErrorBag();
        $this->method = 'createCategory';
        $this->dispatchBrowserEvent('open-modal-category');
    }

    public function editCategory(){
        $this->target->update(['name' => $this->name_update]);
        $this->clean() ;
        $this->emit('filterUpdate');
        $this->emit('successful_alert', 'La categoria '. $this->target->name .' fue actualizado a '. $this->name_update);
    }
    public function addCategory(){
        $category = new CategoryProduct();
        $category->name = $this->name;
        $category->save();
        $this->clean() ;
        $this->emit('filterUpdate');
        $this->emit('successful_alert', 'La categoria '. $category->name .' fue creado');
    }
    public function cancelAddCategory(){
        $this->clean() ;
    }
    public function activeAddCategory(){
        $this->active_category_add = true;
    }
    public function activeUpdateCategory($id){
        $this->active_category_update = true;
        $this->target = CategoryProduct::find($id);
        $this->name_update = $this->target->name;
    }
    public function clean(){
        $this->name = '';
        $this->name_update = '';
        $this->active_category_add = false;
        $this->active_category_update = false;
    }
    public function cerrarModal(){
        $this->dispatchBrowserEvent('close-modal-category');
    }
    public function deleteCategory(CategoryProduct $category){
        $category->delete();
        $this->render();
        $this->emit('filterUpdate');
        $this->emit('successful_alert', 'La categoria '. $category->name .' fue eliminado');
    }
}

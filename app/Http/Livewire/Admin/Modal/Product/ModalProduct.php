<?php

namespace App\Http\Livewire\Admin\Modal\Product;

use App\Http\Requests\UpdateProductRequest;
use App\Models\BrandProduct;
use App\Models\CategoryProduct;
use App\Models\Product;
use App\Models\ProductEstatus;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Livewire\TemporaryUploadedFile;
class ModalProduct extends Component
{
    use WithFileUploads;

    public $classModalDialog = '';
    public $classSize= 'modal-lg';
    public $idModal= 'ProductModal';
    public $method = '';
    public $action = '';
    public $nameComponent = 'Productos';

    public $name;
    public $code;
    public $stock;
    public $image_product = null;
    public $image_url = null;
    public $sale_price;
    public $purchase_price;
    public $unit;
    public $product_status_id;
    public $category_product_id;
    public $brand_product_id;

    public $products = [];
    public $categories = [];
    public $brands = [];
    public $status = [];
    public $target;

    //variables de add marca
    public $active_brand_add = false;
    public $brand_name = '';
    //variables de add category
    public $active_category_add = false;
    public $category_name = '';
    protected $listeners = ['toogleModalProduct'];
    public function addBrand(){
        $brand = new BrandProduct();
        $brand->name = $this->brand_name;
        $brand->save();
        $this->active_brand_add = false;
        $this->brand_name = '';
        $this->hydrate();
        $this->emit('filterUpdate');
        $this->emit('successful_alert', 'Una nueva marca fue creado correctamente');

    }
    public function activeAddBrands()
    {
        $this->active_brand_add = true;
    }
    public function cancelAddBrand(){
        $this->active_brand_add = false;
        $this->brand_name = '';
    }
    public function addCategory(){
        $category = new CategoryProduct();
        $category->name = $this->category_name;
        $category->save();
        $this->active_category_add = false;
        $this->category_name = '';
        $this->hydrate();
        $this->emit('filterUpdate');
        $this->emit('successful_alert', 'Una nueva categoria fue creado correctamente');

    }
    public function activeAddCategory()
    {
        $this->active_category_add = true;
    }
    public function cancelAddCategory(){
        $this->active_category_add = false;
        $this->category_name = '';
    }
    public function submit(){
        if($this->method == 'updateTarget'){
            $this->updateTarget();
        }else{
            $this->createTarget();
        }
    }
    public function clean(){
        $this->name = '';
        $this->code = '';
        $this->stock = '';
        $this->image_product = null;
        $this->image_url = null;
        $this->sale_price = '';
        $this->purchase_price = '';
        $this->unit = '';
        $this->product_status_id = '';
        $this->category_product_id = '';
        $this->brand_product_id = '';
        $this->active_brand_add = false;
        $this->active_status_add = false;
        $this->active_category_add = false;
        $this->brand_name = '';
        $this->status_name = '';
        $this->category_name = '';
    }
    public function cerrarModal(){
        $this->resetValidation();
        $this->resetErrorBag();
       $this->clean();

        $this->dispatchBrowserEvent('close-modal');
    }
    public function hydrate(){
        $this->categories = CategoryProduct::get();
        $this->brands = BrandProduct::pluck('name','id');
        $this->status = ProductEstatus::pluck('name','id');
    }
    public function render()
    {
        return view('livewire.admin.modal.product.modal-product');
    }
    public function toogleModalProduct($model_id = null,$model= null){
        $this->clean();
        $this->resetValidation();
        $this->resetErrorBag();
        if($model_id && $model){
            $this->target = $model == 'Product' ? Product::find($model_id) : '';
            $this->name = $this->target->name;
            $this->code = $this->target->code;
            $this->stock = $this->target->stock;
            $this->image_update = $this->target->image;
            $this->image_url = $this->target->image_product;
            $this->sale_price = $this->target->sale_price;
            $this->purchase_price = $this->target->purchase_price;
            $this->unit = $this->target->unit;
            $this->product_status_id = $this->target->product_status_id;
            $this->category_product_id = $this->target->category_product_id;
            $this->brand_product_id = $this->target->brand_product_id;
            $this->action = 'Actualizar';
            $this->method = 'updateTarget';
        }else{
            $this->stock = 0;
            $this->action = 'Registrar';
            $this->method = 'createTarget';
        }

        $this->dispatchBrowserEvent('open-modal');
    }
    public function updateTarget(){
        $request = new UpdateProductRequest();
        $values = $this->validate($request->rules($this->target), $request->messages());

        if($values['image_product']){
        $this->removeImage($this->target->image);
        }

        if ($values['image_product']){
            $image = ['image' => $this->loadImage($values['image_product'])];
            $values = array_merge($values,$image);
        }

        $this->target->update($values);
        $this->emit('productListUpdate');
        $this->cerrarModal();
        $this->emit('successful_alert','Producto actualizado correctamente');
    }
    public function createTarget(){
        $request = new UpdateProductRequest();
        $values = $this->validate($request->rules($this->target), $request->messages());

        $product = new Product;
        $product->fill($values);

        if ($values['image_product']) {
            $product->image = $this->loadImage($values['image_product']);
        }

        $product->save();
        $this->emit('productListUpdate');
        $this->cerrarModal();
        $this->emit('successful_alert','Producto creado correctamente');
    }
    public function updated($label){
        $request = new UpdateProductRequest();
        $this->validateOnly($label, $request->rules($this->target), $request->messages());
    }
    public function loadImage(TemporaryUploadedFile $image){
        $extension = $image->getClientOriginalExtension();

        $location = Storage::disk('public')->put('products-photos',$image);
        return $location;
    }
    public function removeImage($image){
        if(!$image){
            return ;
        }

        if(Storage::disk('public')->exists($image)){
            Storage::disk('public')->delete($image);
        }
    }
}

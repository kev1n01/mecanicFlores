<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\BrandProduct;
use App\Models\CategoryProduct;
use App\Models\Product;
use App\Models\ProductEstatus;
use Illuminate\Support\Facades\Storage;
use Livewire\{Component, WithPagination};
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Maatwebsite\Excel\Excel;
use App\Http\Livewire\Admin\Purchase\LiveCreatePurchase as AddPurchase;
class LiveProductTable extends Component
{
    use WithPagination;

    // Variables de busqueda
    public $search = '';
    public $nameSearch = '';
    public $stockSearch = '';
    public $codeSearch = '';

    // Variables de paginado y orden
    public $perPage = 5;
    public $camp = null;
    public $order = null;
    public $icon = '-circle';

    // Variables de filtros
    public $product_category_id = '';
    public $product_brand_id = '';
    public $product_status_id = '';
    public $categories = [];
    public $brands = [];
    public $status = [];

    //Variables de exportaciones
    public $selectedRows = [];
    public $selectPageRows = false;

    protected $listeners = [
        'productListUpdate' => 'render',
        'filterUpdate' => 'mount',
        'delproduct' => 'deleteProduct'
    ];
    protected $paginationTheme = 'bootstrap';
    protected $queyString = [
        'search' => ['except' => ''],
        'order' => ['except' => null],
        'camp' => ['except' => null],
    ];
    public function mount()
    {
        $this->icon = $this->iconDirecction($this->order);
        $this->categories = CategoryProduct::pluck('name','id');
        $this->brands = BrandProduct::pluck('name','id');
        $this->status = ProductEstatus::pluck('name','id');
        $this->productsRows = Product::all();

    }

    public function addProductToPurchase(Product $product){
        if ($product->stock > 18){
            $this->emit('warning_alert','Este producto tiene suficiente stock');
        }elseif ($product->product_status_id != 1){
            $this->emit('warning_alert','Este producto no puede ser comprado por que está inactivo 😥');
        }else{
            $purchase = new AddPurchase();
            $purchase->addToCart($product->code);
            $this->emit('successful_alert', 'El producto fue agregado pa comprar');
        }
    }
    public function render()
    {
        $products = Product::with(['category_product','brand_product'])
            ->orWhereHas('category_product',function ($q){
                $q->where('name','like',"%{$this->search}%");
            })
            ->orWhereHas('brand_product',function ($q){
                $q->where('name','like',"%{$this->search}%");
            })
            ->orWhere('name','like',"%{$this->search}%")
                ->orWhere('code','like',"%{$this->search}%")
                ->orWhere('stock','like',"%{$this->search}%")
                ->orWhere('sale_price','like',"%{$this->search}%")
                ->orWhere('purchase_price','like',"%{$this->search}%")
                ->orWhere('unit','like',"%{$this->search}%")
            ->name($this->nameSearch)
            ->stock($this->stockSearch)
            ->code($this->codeSearch);

        if ($this->product_brand_id) {
            $products = $products->brand($this->product_brand_id);
        }
        if ($this->product_category_id) {
            $products = $products->category($this->product_category_id);
        }
        if ($this->product_status_id) {
            $products = $products->status($this->product_status_id);
        }
        if ($this->camp && $this->order) {
            $products = $products->orderBy($this->camp, $this->order);
        } else {
            $this->camp = null;
            $this->order = null;
        }

        $products = $products->paginate($this->perPage);

        //$users=$users->with('nombre de funcion de relacion en el modelo User'(example:users_status))->paginate($this->perPage)
        //En la vista usar for $users as $user => $user->users_status->name

        return view('livewire.admin.product.live-product-table', ['products' => $products])
            ->extends('layouts.admin.app')->section('content');
    }

    //funcion para resetear variables
    public function clear()
    {
        $this->reset(['search',
            'nameSearch',
            'codeSearch',
            'perPage',
            'camp',
            'order',
            'stockSearch',
            'icon',
            'product_category_id',
            'product_brand_id',
            'product_status_id']);
        $this->resetPage();
    }

    // funcion de livewire que actualiza una variable
    public function updatingSearch()
    {
        $this->resetPage(); //resetea a la primera página
    }

    // funcion para ordenar ascendente o descente los campos
    public function sortable($camp)
    {
        if ($camp !== $this->camp) {
            $this->order = null;
        }
        switch ($this->order) {
            case null:
                $this->order = 'asc';
                $this->icon = '-sort-amount-down-alt';
                break;
            case 'asc':
                $this->order = 'desc';
                $this->icon = '-sort-amount-down';
                break;
            case 'desc':
                $this->order = null;
                $this->icon = '-sort';
                break;
        }
        $this->icon = $this->iconDirecction($this->order);
        $this->camp = $camp;
    }

    // funcion que controla la direccion de los iconos
    public function iconDirecction($sort): string
    {
        if (!$sort) {
            return '-sort';
        }
        return $sort === 'asc' ? '-sort-amount-down-alt' : '-sort-amount-down';
    }

    // funcion que elimina un usuario
    public function deleteProduct(Product $product)
    {
        can('usuario delete');
        $image_product = $product->image_product;
        if ($image_product == 'products-photos/default.jpg'){
            $product->delete();
            $this->emit('successful_alert', 'El producto ' . $product->name . ' eliminado correctamente');
        }else{
            if (Storage::disk('public')->exists($image_product)) {//verifica si exite un archivo con la direccion en la carpeta public/storage
                Storage::disk('public')->delete($image_product);//elimina un archivo de la carpeta public/storage
            }
            $product->delete();
            $this->emit('successful_alert', 'El producto ' . $product->name . ' eliminado correctamente');
        }
    }

    //funcion para actualizar las filas seleccionados
    public function updatedSelectPageRows($value)
    {
        if ($value) {
            $this->selectedRows = $this->productsRows->pluck('id')
                ->map(function ($id) {
                    return (string)$id;
                });
        } else {
            $this->reset(['selectedRows', 'selectPageRows']);
        }
    }

    //funcion para exportar por xlsx o pdf o csv las filas seleccionadas
    public function export($type)
    {
        if ($type == 'excel') {
            return (new ProductsExport($this->selectedRows))->download('products.xlsx');
        } elseif ($type == 'csv') {
            return (new ProductsExport($this->selectedRows))->download('products.csv', Excel::CSV);
        } else {

        }
    }

    public function pdfdownload()
    {
        $products = Product::all();
        $pdf = PDF::loadView('exports.productsExport', compact('products'));
        return $pdf->stream('Reporte_productos.pdf');
    }

    //funciona que elimina las filas seleccionadas
    public function deleteSelectedRows()
    {
        Product::whereIn('id', $this->selectedRows)->delete();
        $this->emit('successful_alert', 'Los productos seleccionados fueron eliminados');
        $this->reset(['selectPageRows', 'selectedRows']);
    }


}

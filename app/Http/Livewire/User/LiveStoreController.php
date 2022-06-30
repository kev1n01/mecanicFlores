<?php

namespace App\Http\Livewire\User;

use App\Models\BrandProduct;
use App\Models\CategoryProduct;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class LiveStoreController extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $perPage = 9;
    public $categories = [];
    public $brands = [];
    public $product_brand_id = null ;
    public $product_category_id = null ;
    public $camp = null;
    public $order = null;

    public function addidcategory($id){
        $this->product_category_id = $id;
//        dd($id);
    }
    public function addidbrand($id){
        $this->product_brand_id = $id;
//        dd($id);
    }

    public function mount(){
        $this->categories = CategoryProduct::withCount(['products'])->get();
        $this->brands = BrandProduct::withCount(['products'])->get();
//        dd($this->$elements);
    }
    public function hydrate(){
        $this->categories = CategoryProduct::withCount(['products'])->get();
        $this->brands = BrandProduct::withCount(['products'])->get();
//        dd($this->$elements);
    }

    public function render()
    {
        $products = Product::with(['category_product','brand_product'])
            ->where('product_status_id',1)
            ->orWhere('stock','>=',1)
            ->orWhereHas('category_product',function ($q){
                $q->where('id','like',"%{$this->product_category_id}%");
            })
            ->orWhereHas('brand_product',function ($q){
                $q->where('id','like',"%{$this->product_brand_id}%");
            });
        if ($this->product_category_id != null){
            $products = $products->category($this->product_category_id);
        }
        if ($this->product_brand_id != null){
            $products = $products->brand($this->product_brand_id);
        }

        if ($this->camp && $this->order) {
            $products = $products->orderBy($this->camp, $this->order);
        } else {
            $this->camp = null;
            $this->order = null;
        }

        $products = $products->paginate($this->perPage);
        return view('livewire.user.live-store-controller',compact('products'))
            ->extends('layouts.user.app')->section('content');
    }
    public function sortable($camp)
    {
        if ($camp !== $this->camp) {
            $this->order = null;
        }
        switch ($this->order) {
            case null :
                $this->order = 'asc';
                break;
            case 'asc':
                $this->order = 'desc';
                break;
            case 'desc':
                $this->order = 'asc';
                break;
        }
        $this->camp = $camp;
    }

    public function addToCartStore($barcode){
        $gocart = new LiveCartController();
        $gocart->addToCart($barcode);
        $this->emit('successful_alert','El producto fue agregado');

    }
}

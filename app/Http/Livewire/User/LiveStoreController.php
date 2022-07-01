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
    public $filters = [
        'categories' =>[],
        'brands' =>[],
    ];

    public $camp = null;
    public $order = null;


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
        if (empty($this->filters['categories']))
        {
            $products = Product::where('product_status_id',1)
                ->orWhere('stock','>=',1)->paginate($this->perPage);
//            dd($products);
        }

        if ($this->filters['categories']) {
            $this->filters['categories'] = array_filter($this->filters['categories']);
            $products = Product::whereIn('category_product_id', array_keys($this->filters['categories']))
                ->paginate($this->perPage);
//            dd($products);
        }

        if ($this->filters['brands']){
            $this->filters['brands'] = array_filter($this->filters['brands']);
            $products = Product::whereIn('brand_product_id',array_keys($this->filters['brands']))
                ->paginate($this->perPage);
//                        dd($products);

        }

        if ($this->camp && $this->order) {
            $products = Product::orderBy($this->camp, $this->order)
                ->paginate($this->perPage);
        } else {
            $this->camp = null;
            $this->order = null;
        }

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

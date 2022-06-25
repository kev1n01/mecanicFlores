<?php

namespace App\Http\Livewire\User;

use App\Models\CategoryProduct;
use App\Models\Product;
use Livewire\Component;
class HomeController extends Component
{
    public $isactive = 'activenew';
    public $product_category_id = 1;
    public $cn;
    public function mount(){
        $this->cn = CategoryProduct::where('id',$this->product_category_id)->get();
    }


    public function render()
    {
        $categories = CategoryProduct::all();
        $productsnew = Product::latest()->take(10)
            ->where('category_product_id',$this->product_category_id)
            ->get();

        $productsbestseller = Product::join('sale_details as d','d.product_id','products.id')
            ->select('products.name','products.sale_price','products.purchase_price','products.image','d.quantity')
            ->where('d.quantity','>', 10)
            ->take(5)
            ->get();

        if ($this->product_category_id) {
//            $productsbestseller = $productsbestseller->category($this->product_category_id);
//            $productsnew = $productsnew->category($this->product_category_id);
        }
        return view('livewire.user.home-controller', ['productsnew' => $productsnew,'productsbestseller' => $productsbestseller,'categories' => $categories])
            ->extends('layouts.user.app')->section('content');
    }
    public function activetab(){
        if ($this->isactive == 'activenew'){
            $this->isactive = 'activemore';
        }elseif($this->isactive == 'activemore'){
            $this->isactive = 'activenew';
        }
    }
}

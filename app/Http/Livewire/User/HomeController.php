<?php

namespace App\Http\Livewire\User;

use App\Models\CategoryProduct;
use App\Models\Product;
use Livewire\Component;
class HomeController extends Component
{

    public function render()
    {
        $products = Product::where('product_status_id',1)
            ->latest()->take(5)
            ->get();
//        dd($products);
        return view('livewire.user.home-controller', ['products' => $products])
            ->extends('layouts.user.app')->section('content');
    }

    public function addToCartHome($barcode){
        $gocart = new LiveCartController();
        $gocart->addToCart($barcode);
        $this->emit('successful_alert','El producto fue agregado');

    }

}

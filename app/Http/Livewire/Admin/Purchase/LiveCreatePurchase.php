<?php

namespace App\Http\Livewire\Admin\Purchase;

use App\Models\PurchaseEstatus;
use Livewire\Component;

use App\Models\Provider;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use function Symfony\Component\Translation\t;

class LiveCreatePurchase extends Component
{
    public $providers, $provider, $search;
    public $invoice_code, $observation;
    public $date_purchase , $status_id, $status;
    public function mount()
    {
        $this->status_id = 1;
        $this->invoice_code = $this->generator_code_random(4);
        $this->providers = Provider::all();
        $this->status = PurchaseEstatus::pluck('name','id');

    }

    public function generator_code_random($longitud){
        $codigo="";
        $caracter="Letra";
        for($i=1; $i<=$longitud; $i++){
            if($caracter=="Letra"){
                $letra_aleatoria=chr(rand(ord("a"),ord("z")));
                $letra_aleatoria=strtoupper($letra_aleatoria);
                $codigo.=$letra_aleatoria;
                $caracter="Numero";
            }else{
                $numero_aleatorio=rand(0,9);
                $codigo.=$numero_aleatorio;
                $caracter="Letra";
            }
        }
        return 'C-'.$codigo;
    }
    public function render()
    {
        $products = Product::termino($this->search)->status(1);
        $products = $products->status(1)->get();
        $cart_content = Cart::getContent()->sortBy('name');
        $total = Cart::getTotal();
        $items_count = Cart::getTotalQuantity();

        return view('livewire.admin.purchase.live-create-purchase',
            compact('cart_content', 'total', 'products', 'items_count'))
            ->extends('layouts.admin.app')->section('content');
    }

    public function removeItem($remove_id)
    {
        Cart::remove($remove_id);
        $this->emit('successful_alert', 'Se eleminó el producto');
    }
    public function quantityMinus($product_id)
    {
        $product = Product::find($product_id);
        $item = Cart::get($product_id);
        $new_quantity = $item->quantity - 1;
        if ($new_quantity > 0) {
            Cart::remove($product->id);
            Cart::add($product->id, $product->name, $product->purchase_price, $new_quantity, $product->image_product);
            $this->emit('successful_alert', 'Cantidad reducida!');
        } else {
            $this->emit('warning_alert', 'No se puede reducir la cantidad!');
        }
    }

    public function quantityPlus($product_id, $quantity = 1)
    {
        $product = Product::find($product_id);
        Cart::add($product->id, $product->name, $product->purchase_price, $quantity, $product->image_product);
        $this->emit('successful_alert', 'Cantidad aumentada!');

    }
    public function addToCart($product_id)
    {
        $product = Product::find($product_id);
        Cart::add($product->id, $product->name, $product->purchase_price, 1, $product->image_product);
        $this->emit('successful_alert', 'Producto agregado!');
    }

    public function clearCart()
    {
        Cart::clear();
        $this->emit('successful_alert', 'Carrito limpiado!');
    }

    public function resetSearch()
    {
        $this->search = '';
        $this->emit('successful_alert', 'Busqueda restablecido!');
    }

    public function savePurchase()
    {
        $this->validate([
            'provider' => 'required',
            'status_id' => 'required',
            'invoice_code' => 'required',
            'date_purchase' => 'required',
            'observation' => 'nullable|max:50',
        ]);

        $items_count = Cart::getTotalQuantity();
        if ($items_count > 0) {
            $purchase = Purchase::create([
                'provider_id' => $this->provider,
                'user_id' => auth()->user()->id,
                'total' => Cart::getTotal(),
                'code_purchase' => $this->invoice_code,
                'date_purchase' => $this->date_purchase,
                'observation' => $this->observation,
                'status' => $this->status_id
            ]);

            foreach (Cart::getContent() as $key => $value) {
                PurchaseDetail::create([
                    'purchase_id' => $purchase->id,
                    'product_id' => $value->id,
                    'quantity' => $value->quantity,
                    'price' => $value->price,
                ]);

                $product = Product::find($value->id);
                $product->stock = $product->stock + $value->quantity;
                $product->save();
            }
            Cart::clear();
            $this->emit('successful_alert', 'Compra realizada!');
            return redirect()->route('purchases.table');
        } else {
            $this->emit('warning_alert', 'Carrito vacio!, Seleccione un producto');

        }
    }

    public function cancelPurchase()
    {
        Cart::clear();
        $this->search = '';
        $this->emit('warning_alert', 'Compra cancelada!');
        return redirect()->route('purchases.table');
    }
}


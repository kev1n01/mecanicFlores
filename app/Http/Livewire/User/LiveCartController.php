<?php

namespace App\Http\Livewire\User;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Sale;
use App\Models\SaleDetails;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use DB;
use Illuminate\Support\Facades\Redirect;

class LiveCartController extends Component
{
    public $total,$itemsQuantity;
    public function render()
    {
        return view('livewire.user.live-cart-controller',['cart' => Cart::getContent()->sortBy('name')])
            ->extends('layouts.user.app')->section('content');
    }
    public function addToCart($barcode,$cant=1){
        $product = Product::where('code',$barcode)->first();
//        dd($product);
            if ($product->stock < 1){
                $this->emit('warning_alert','Este producto no cuenta con suficiente stock');
            }else{
                if($this->InCart($product->id)){
                    $this->increaseQty($product->id);
                    return ;
                }
                Cart::add($product->id,$product->name,$product->sale_price,$cant,$product->image_product);
                $this->total = Cart::getTotal();
//                dd($this->total);
                $this->itemsQuantity = Cart::getTotalQuantity();
                $this->emit('successful_alert','El producto fue agregado');
            }
    }

    public function InCart($productId){
        $exist = Cart::get($productId);
        if ($exist)
            return true;
        else
            return false;
    }
    public function increaseQty($productId, $cant=1){
        $title = '';
        $product = Product::find($productId);
        $exist = Cart::get($productId);
        if ($exist){
            $title = 'Cantidad actualizada';
        }else{
            $title = 'Producto agregado';
        }

        if ($exist){
            if ($product->stock < ($cant + $exist->quantity)){
                $this->emit('warning_alert', 'Stock insuficiente 😥');
                return;
            }
        }
        Cart::add($product->id,$product->name,$product->sale_price,$cant,$product->image_product);
        $this->total =Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();
        $this->emit('successful_alert', $title);
    }
    public function decreaseQty($productId){
        $product = Cart::get($productId);
        Cart::remove($productId);

        $newQty = ($product->quantity) - 1;
        if ($newQty > 0)
        {
            Cart::add($product->id,$product->name,$product->sale_price,$newQty,$product->attributes[0]);
        }
        $this->total =Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();
        $this->emit('successful_alert', 'Cantidad actualizada');
    }

    public function updateQuantity($productId, $cant=1){
        $title = '';
        $product = Product::find($productId);
        $exist = Cart::get($productId);
        if ($exist){
            $title = 'Cantidad actualizada';
        }else{
            $title = 'Producto agregado';
        }

        if ($exist){
            if($product->stock < $cant)
            {
                $this->emit('warning_alert', 'Stock insuficiente ');
                return;
            }
        }
        $this->removeItem($productId);
        if ($cant > 0){
            Cart::add($product->id,$product->name,$product->sale_price,$cant,$product->image_product);
            $this->total =Cart::getTotal();
            $this->itemsQuantity = Cart::getTotalQuantity();
            $this->emit('successful_alert', $title);
        }else{
            $this->emit('successful_alert', 'La cantidad debe ser mayor a 0');
        }
    }
    public function removeItem($productId){
        Cart::remove($productId);
        $this->total =Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();
        $this->emit('successful_alert', 'El producto se eliminó del carrito');
    }
    public function clearCart(){
        Cart::clear();
        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();
        $this->emit('successful_alert', 'Carrito vacio');
    }

    public function saveSale()
    {
        if($this->total <= 0)
        {
            $this->emit('warning_alert', 'Agregar productos para comprar');
            return;
        }

        DB::beginTransaction();
        if (Auth::user()){
            try {
                $sale = Sale::create([
                    'total' => $this->total,
                    'items' => $this->itemsQuantity,
                    'cash' => 0,
                    'change' => 0,
                    'user_id' => Auth()->user()->id,
                    'customer_id' => Auth()->user()->id,
                ]);
                if ($sale){
                    $items = Cart::getContent();
                    foreach ($items as $item) {
                        SaleDetails::create([
                            'price' => $item->price,
                            'quantity' => $item->quantity,
                            'product_id' => $item->id,
                            'sale_id' => $sale->id,
                        ]);

                        //update stock product saled
                        $product = Product::find($item->id);
                        $product->stock = $product->stock - $item->quantity;
                        $product->save();
                    }
                }
                DB::commit();
                Cart::clear();
                $this->total = Cart::getTotal();
                $this->itemsQuantity = Cart::getTotalQuantity();
                $this->emit('successful_alert', '¡Orden registrada!');
            }catch (\Exception $e){
                DB::rollback();
                $this->emit('warning_alert', $e->getMessage());
            }
        }else{
            $this->dispatchBrowserEvent('open-modal-login');
            $this->emit('warning_alert', 'Inicie sesión antes de comprar');

        }
    }

}

<?php

namespace App\Http\Livewire\Admin\Sale;

use App\Models\Denomination;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetails;
use App\Models\User;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class LiveCreateSale extends Component
{
    public $total,$itemsQuantity,$efectivo,$change,$customer_id,$customers = [];
    public $identidad_customer, $phone_customer,$product_category, $product_brand;
    protected $listeners = [
        'scan-code' => 'ScanCode',
        'removeItem' => 'removeItem',
        'clearCart' => 'clearCart',
        'saveSale' => 'saveSale',
    ];

    public function mount(){
        $this->efectivo = 0;
        $this->change = 0;
        $this->customers = User::role('cliente')->get();
        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();
    }

    public function updated(){
        $customerget = User::find($this->customer_id);
        $this->phone_customer = $customerget->phone;
        if($customerget->dni){
            $this->identidad_customer = $customerget->dni;
        }else{
            $this->identidad_customer = $customerget->ruc;
        }
    }

    public function render()
    {
        return view('livewire.admin.sale.live-create-sale', [
                'denominations' => Denomination::orderBy('value','desc')->get(),
            'cart' => Cart::getContent()->sortBy('name')])
            ->extends('layouts.admin.app')->section('content');
    }
    public function ACash($value){
        $this->efectivo += ($value == 0 ? $this->total : $value);
        $this->change = ($this->efectivo - $this->total);
    }
    public function clearEfectivo(){
        $this->efectivo = 0;
        $this->change = 0;
    }

    public function ScanCode($barcode,$cant=1){
        $product = Product::where('code',$barcode)->first();
        if ($product == null ) {
            $this->emit('warning_alert', 'El producto no está registrado');
        }else{
            if ($product->stock < 1){
                $this->emit('warning_alert','Este producto no cuenta con suficiente stock 😥');
            }elseif ($product->product_status_id != 1){
                $this->emit('warning_alert','Este producto no puede ser vendido por que está inactivo 😥');
            }else{
                $this->product_category = $product->category_product->name;
                $this->product_brand = $product->brand_product->name;
                if($this->InCart($product->id)){
                    $this->increaseQty($product->id);
                    return ;
                }
                Cart::add($product->id,$product->name,$product->sale_price,$cant,$product->image_product);
                $this->total = Cart::getTotal();
                $this->itemsQuantity = Cart::getTotalQuantity();
//                dd($this->itemsQuantity);

                $this->emit('successful_alert','El producto fue agregado');
        //      $this->mount();
            }
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
                $this->emit('warning_alert', 'Stock insuficiente 😥');
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
        $this->efectivo = 0;
        $this->change = 0;
        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();
        $this->emit('successful_alert', 'Carrito vacio');
    }
    public function saveSale()
    {
        if($this->total <= 0)
        {
            $this->emit('warning_alert', 'AGEGA PRODUCTOS A LA VENTA');
            return;
        }
        if($this->efectivo <=0)
        {
            $this->emit('warning_alert', 'INGRESA EL EFECTIVO');
            return;
        }
        if($this->total > $this->efectivo)
        {
            $this->emit('warning_alert', 'EL EFECTIVO DEBE SER MAYOR O IGUAL AL TOTAL');
            return;
        }
        DB::beginTransaction();

        try {
            $sale = Sale::create([
                'total' => $this->total,
                'items' => $this->itemsQuantity,
                'cash' => $this->efectivo,
                'change' => $this->change,
                'user_id' => Auth()->user()->id,
                'customer_id' => $this->customer_id,
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
            $this->efectivo = 0;
            $this->change = 0;
            $this->total = Cart::getTotal();
            $this->itemsQuantity = Cart::getTotalQuantity();
            $this->emit('successful_alert', 'Venta registrada!');
            $this->emit('print_ticket', $sale->id);
        }catch (\Exception $e){
            DB::rollback();
            $this->emit('warning_alert', $e->getMessage());
        }
    }

    public function printTicket($sale){
        return Redirect::to("print://$sale->id");
    }
}

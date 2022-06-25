<?php

namespace App\Http\Livewire\Admin\Purchase;

use App\Models\PurchaseEstatus;
use App\Models\User;
use Livewire\Component;
use App\Models\Provider;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use DB;
use Illuminate\Support\Facades\Redirect;
use Livewire\WithPagination;
use function Symfony\Component\Translation\t;

class LiveCreatePurchase extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $total,$itemsQuantity,$provider_id,$status = [],$providers = [], $product_category, $product_brand
    ,$ruc_provider, $phone_provider,$search,$code_purchase, $observation ,$date_purchase
    ,$status_id;
    protected $listeners = [
        'addToCart' => 'addToCart',
        'removeItem' => 'removeItem',
        'clearCart' => 'clearCart',
        'savePurchase' => 'savePurchase',
    ];
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
    public function mount(){
        $this->status_id = 1;
        $this->code_purchase = $this->generator_code_random(4);
        $this->status = PurchaseEstatus::pluck('name','id');
        $this->providers = Provider::all();
        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();
    }
    public function updated(){
        $providerget= Provider::find($this->provider_id);
        $this->phone_provider = $providerget->phone;
        $this->ruc_provider = $providerget->ruc;
    }
    public function resetSearch()
    {
        $this->search = '';
    }
    public function render()
    {
        $products = Product::termino($this->search)
                    ->status(1)->where('stock','<=',5);

        $products = $products->simplePaginate(2);
        return view('livewire.admin.purchase.live-create-purchase', [
            'products' => $products,
            'cart' => Cart::getContent()->sortBy('name')])
            ->extends('layouts.admin.appenetero')->section('content');
    }
    public function addToCart($code,$cant=1){
        $product = Product::where('code',$code)->first();
        if ($product == null ) {
            $this->emit('warning_alert', 'El producto no está registrado');
        }else{
            if ($product->stock > 18){
                $this->emit('warning_alert','Este producto tiene suficiente stock');
            }elseif ($product->product_status_id != 1){
                $this->emit('warning_alert','Este producto no puede ser comprado por que está inactivo 😥');
            }else{
                if($this->InCart($product->id)){
                    $this->increaseQty($product->id);
                    return ;
                }
                Cart::add($product->id,$product->name,$product->purchase_price,$cant,$product->image_product);
                $this->total = Cart::getTotal();
                $this->itemsQuantity = Cart::getTotalQuantity();

                $this->emit('successful_alert','El producto fue agregado a la compra');
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

        Cart::add($product->id,$product->name,$product->purchase_price,$cant,$product->image_product);
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
            Cart::add($product->id,$product->name,$product->purchase_price,$newQty,$product->attributes[0]);
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

        $this->removeItem($productId);
        if ($cant > 0){
            Cart::add($product->id,$product->name,$product->purchase_price,$cant,$product->image_product);
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
    public function savePurchase()
    {
        if($this->total <= 0)
        {
            $this->emit('warning_alert', 'AGEGA PRODUCTOS A LA COMPRA');
            return;
        }
        DB::beginTransaction();
//        'provider_id',
//        'user_id',
//        'total',
//        'code_purchase',
//        'date_purchase',
//        'observation',
//        'status',
        try {
            $purchase= Purchase::create([
                'user_id' => Auth()->user()->id,
                'provider_id' => $this->provider_id,
                'total' => $this->total,
                'code_purchase' => $this->code_purchase,
                'date_purchase' => $this->date_purchase,
                'observation' => $this->observation,
                'status' => $this->status_id,
            ]);
            if ($purchase){
                $items = Cart::getContent();
                foreach ($items as $item) {
                    PurchaseDetail::create([
                        'price' => $item->price,
                        'quantity' => $item->quantity,
                        'product_id' => $item->id,
                        'purchase_id' => $purchase->id,
                    ]);

                    //update stock product saled
                    $product = Product::find($item->id);
                    $product->stock = $product->stock + $item->quantity;
                    $product->save();
                }
            }
            DB::commit();
            Cart::clear();
            $this->total = Cart::getTotal();
            $this->itemsQuantity = Cart::getTotalQuantity();
            $this->emit('successful_alert', 'Compra registrada!');
        }catch (\Exception $e){
            DB::rollback();
            $this->emit('warning_alert', $e->getMessage());
        }
    }
}


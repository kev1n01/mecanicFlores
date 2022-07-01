<?php

namespace App\Http\Livewire\User\Modal;

use App\Models\Sale;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Modalpurchasedetail extends Component
{
    public $classModalDialog = '';
    public $classSize= 'modal-lg';
    public $idModal= 'DetailsModal';
    public $method = '';
    public $action = '';
    public $nameComponent = 'Detalle de Compra';
    public $details = [];

    protected $listeners = ['toogleModalDetail'];
    public function render()
    {
        return view('livewire.user.modal.modalpurchasedetail');
    }
    public function toogleModalDetail($saleid){

        $this->details = Sale::join('sale_details as d','d.sale_id','sales.id')
            ->join('products as p','p.id','d.product_id')
            ->select('d.sale_id','p.name as product','d.quantity','d.price')
            ->where('sales.customer_id', Auth::user()->id)
            ->where('sales.id', $saleid)
            ->get();

        $this->dispatchBrowserEvent('open-modal-detail');
    }
    public function cerrarModal(){
        $this->dispatchBrowserEvent('close-modal-detail');

    }
}

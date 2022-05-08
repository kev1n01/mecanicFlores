<?php

namespace App\Http\Livewire\Admin\Modal\Cashout;

use App\Models\Sale;
use Livewire\Component;

class ModalCashout extends Component
{
    public $classModalDialog = '';
    public $classSize= 'modal-lg';
    public $idModal= 'DetailsModal';
    public $method = '';
    public $action = '';
    public $nameComponent = 'Detalles de venta';
    public $details = [];

    protected $listeners = ['toogleModalDetail'];

    public function render()
    {
        return view('livewire.admin.modal.cashout.modal-cashout');
    }
    public function toogleModalDetail($fi,$ff,$userid,$saleid){

        $this->details = Sale::join('sale_details as d','d.sale_id','sales.id')
            ->join('products as p','p.id','d.product_id')
            ->select('d.sale_id','p.name as product','d.quantity','d.price')
            ->whereBetween('sales.created_at', [$fi,$ff])
//            ->where('status_sale_id',1)
            ->where('sales.user_id', $userid)
            ->where('sales.id', $saleid)
            ->get ();

        $this->method = 'ShowDetails';
        $this->dispatchBrowserEvent('open-modal-detail');
    }
    public function cerrarModal(){
        $this->dispatchBrowserEvent('close-modal-detail');

    }
}

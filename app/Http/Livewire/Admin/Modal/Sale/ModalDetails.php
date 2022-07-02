<?php

namespace App\Http\Livewire\Admin\Modal\Sale;

use App\Models\Sale;
use Livewire\Component;

class ModalDetails extends Component
{
    public $classModalDialog = '';
    public $classSize= 'modal-lg';
    public $idModal= 'SaleDetailsModal';
    public $method = '';
    public $action = '';
    public $nameComponent = 'Detalles de venta';
    public $details = [];

    protected $listeners = ['toogleSaleModalDetails'];
    public function render()
    {
        return view('livewire.admin.modal.sale.modal-details');
    }
     public function toogleSaleModalDetails($customerid,$saleid){

        $this->details = Sale::join('sale_details as d','d.sale_id','sales.id')
            ->join('products as p','p.id','d.product_id')
            ->select('d.sale_id','p.name as product','d.quantity','d.price')
            ->where('sales.customer_id', $customerid)
            ->where('sales.id', $saleid)
            ->get ();

        $this->method = 'ShowDetails';
        $this->dispatchBrowserEvent('open-modal-detail');
    }
    public function cerrarModal(){
        $this->dispatchBrowserEvent('close-modal-detail');

    }
}

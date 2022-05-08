<?php

namespace App\Http\Livewire\Admin\Sale;

use App\Models\Sale;
use App\Models\SaleEstatus;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class LiveSaleTable extends Component
{
    use WithPagination;

    // Variables de busqueda
    public $search = '';

    // Variables de paginado y orden
    public $perPage = 5;
    public $camp = null;
    public $order = null;
    public $icon = '-circle';

    //Variables de exportaciones
    public $selectedRows = [];
    public $selectPageRows = false;

    protected $listeners = [
        'saleListUpdate' => 'render',
    ];

    protected $paginationTheme = 'bootstrap';

    protected $queyString = [
        'search' => ['except' => ''],
        'order' => ['except' => null],
        'camp' => ['except' => null],
    ];

    public function mount()
    {
        $this->icon = $this->iconDirecction($this->order);
        $this->saleRows = Sale::all();
        $this->status = SaleEstatus::pluck('name','id');
        $this->userCustomers = User::role('cliente')->get();
        $this->userSellers = User::role('vendedor')->get();
    }

    public function render()
    {
        $sales = Sale::termino($this->search);
//
//        if ($this->sale_status_id) {
//            $sales = $sales->status($this->purchase_status_id);
//        }
//        if ($this->user_id) {
//            $sales = $sales->use($this->user_id);
//        }
//        if ($this->provider_id) {
//            $sales = $sales->provide($this->provider_id);
//        }

        if ($this->camp && $this->order) {
            $sales = $sales->orderBy($this->camp, $this->order);
        } else {
            $this->camp = null;
            $this->order = null;
        }

        $sales = $sales->paginate($this->perPage);
        return view('livewire.admin.sale.live-sale-table',compact('sales'))
            ->extends('layouts.admin.app')->section('content');
    }

    public function clear()
    {
        $this->reset(['search',
            'perPage',
            'camp',
            'order',
            'icon',
        ]);
        $this->resetPage();
    }

    // funcion de livewire que actualiza una variable
    public function updatingSearch()
    {
        $this->resetPage(); //resetea a la primera página
    }

    // funcion para ordenar ascendente o descente los campos
    public function sortable($camp)
    {
        if($camp !== $this->camp){
            $this->order = null;
        }
        switch ($this->order) {
            case null:
                $this->order = 'asc';
                $this->icon = '-sort-amount-down-alt';
                break;
            case 'asc':
                $this->order = 'desc';
                $this->icon = '-sort-amount-down';
                break;
            case 'desc':
                $this->order = null;
                $this->icon = '-sort';
                break;
        }
        $this->icon = $this->iconDirecction($this->order);
        $this->camp = $camp;
    }

    // funcion que controla la direccion de los iconos
    public function iconDirecction($sort): string
    {
        if (!$sort) {
            return '-sort';
        }
        return $sort === 'asc' ? '-sort-amount-down-alt' : '-sort-amount-down';
    }

    // funcion que elimina un usuario
    public function deleteSale(Sale $sale)
    {
        can('usuario delete');
        $sale->delete();
    }
}

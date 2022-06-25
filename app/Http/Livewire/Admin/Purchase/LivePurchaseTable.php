<?php

namespace App\Http\Livewire\Admin\Purchase;

use App\Models\Provider;
use App\Models\Purchase;
use App\Models\PurchaseEstatus;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class LivePurchaseTable extends Component
{
    use WithPagination;

    // Variables de busqueda
    public $search = '';
    public $codeSearch = '';
    public $dateSearch = '';
    public $observationSearch = '';

    // Variables de paginado y orden
    public $perPage = 5;
    public $camp = null;
    public $order = null;
    public $icon = '-circle';

    public $purchase_status_id = '';
    public $status = [];
    public $provider_id = '';
    public $providers = [];
    public $user_id = '';
    public $users = [];
    //Variables de exportaciones
    public $selectedRows = [];
    public $selectPageRows = false;

    protected $listeners = [
        'purchaseListUpdate' => 'render',
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
        $this->purchasesRows = Purchase::all();
        $this->status = PurchaseEstatus::pluck('name','id');
        $this->users = User::pluck('name','id');
        $this->providers = Provider::pluck('name','id');

    }
    public function render()
    {
        $purchases = Purchase::termino($this->search)
            ->code($this->codeSearch)
            ->date($this->dateSearch)
            ->observation($this->observationSearch);

        if ($this->purchase_status_id) {
            $purchases = $purchases->status($this->purchase_status_id);
        }
        if ($this->user_id) {
            $purchases = $purchases->use($this->user_id);
        }
        if ($this->provider_id) {
            $purchases = $purchases->provide($this->provider_id);
        }
        if ($this->camp && $this->order) {
            $purchases = $purchases->orderBy($this->camp, $this->order);
        } else {
            $this->camp = null;
            $this->order = null;
        }

        $purchases = $purchases->paginate($this->perPage);
        return view('livewire.admin.purchase.live-purchase-table', compact('purchases'))
            ->extends('layouts.admin.appenetero')->section('content');
    }

    //funcion para resetear variables
    public function clear()
    {
        $this->reset(['search',
            'codeSearch',
            'dateSearch',
            'observationSearch',
            'perPage',
            'camp',
            'order',
            'icon',
            'purchase_status_id',
            'user_id',
            'provider_id',
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
                $this->icon = '-sort-amount-asc';
                break;
            case 'asc':
                $this->order = 'desc';
                $this->icon = '-sort-amount-desc';
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
        return $sort === 'asc' ? '-sort-amount-asc' : '-sort-amount-desc';
    }

    // funcion que elimina un usuario
    public function deletePurchase(Purchase $purchase)
    {
        can('usuario delete');
        $purchase->delete();
    }
}

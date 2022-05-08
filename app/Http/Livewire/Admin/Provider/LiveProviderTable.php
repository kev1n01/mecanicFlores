<?php

namespace App\Http\Livewire\Admin\Provider;

use App\Models\Provider;
use App\Models\ProviderEstatus;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class LiveProviderTable extends Component
{
    use WithPagination;

    // Variables de busqueda
    public $search = '';
    public $nameSearch = '';
    public $phoneSearch = '';
    public $addressSearch = '';
    public $rucSearch = '';
    public $companySearch = '';

    // Variables de paginado y orden
    public $perPage = 5;
    public $camp = null;
    public $order = null;
    public $icon = '-circle';

    public $provider_status_id = '';
    public $status = [];

    //Variables de exportaciones
    public $selectedRows = [];
    public $selectPageRows = false;

    protected $listeners = [
        'productListUpdate' => 'render',
        'delprovider' => 'deleteProvider',
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
        $this->providersRows = Provider::all();
        $this->status = ProviderEstatus::pluck('name','id');

    }
    public function render()
    {

        $providers = Provider::termino($this->search)
            ->name($this->nameSearch)
            ->phone($this->phoneSearch)
            ->address($this->addressSearch)
            ->ruc($this->rucSearch)
            ->company($this->companySearch);
        if ($this->provider_status_id) {
            $providers = $providers->status($this->provider_status_id);
        }
        if ($this->camp && $this->order) {
            $providers = $providers->orderBy($this->camp, $this->order);
        } else {
            $this->camp = null;
            $this->order = null;
        }

        $providers = $providers->paginate($this->perPage);
        return view('livewire.admin.provider.live-provider-table', compact('providers'))
            ->extends('layouts.admin.app')->section('content');
    }
    //funcion para resetear variables
    public function clear()
    {
        $this->reset(['search',
            'nameSearch',
            'phoneSearch',
            'addressSearch',
            'rucSearch',
            'companySearch',
            'perPage',
            'camp',
            'order',
            'icon',
            'provider_status_id',
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
        if ($camp !== $this->camp) {
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
    public function deleteProvider(Provider $provider)
    {
        can('usuario delete');
        $image_provider = $provider->image_provider;
        if ($image_provider == 'providers-photos/default.jpg'){
            $provider->delete();
            $this->emit('successful_alert', 'El proveedor ' . $provider->name . ' fue eliminado correctamente');
        }else{
            if (Storage::disk('public')->exists($image_provider)) {//verifica si exite un archivo con la direccion en la carpeta public/storage
                Storage::disk('public')->delete($image_provider);//elimina un archivo de la carpeta public/storage
            }
            $provider->delete();
            $this->emit('successful_alert', 'El proveedor ' . $provider->name . ' fue eliminado correctamente');
        }
    }
}

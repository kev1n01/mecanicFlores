<?php

namespace App\Http\Livewire\Admin\Service;

use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class LiveServiceTable extends Component
{
    use WithPagination;

    // Variables de busqueda
    public $search = '';
    public $cardSearch = '';
    public $dateSearch = '';
    public $plateSearch = '';

    // Variables de paginado y orden
    public $perPage = 5;
    public $camp = null;
    public $order = null;
    public $icon = '-circle';

    public $employers = [];
    public $employer_id = '';
    public $customers = [];
    public $customer_id = '';

    //Variables de exportaciones
    public $selectedRows = [];
    public $selectPageRows = false;

    protected $listeners = [
        'serviceListUpdate' => 'render',
        'delService' => 'deleteService',
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
        $this->servicesRows = Service::all();
        $this->customers = User::role('cliente')->get();
        $this->employers = User::role('empleado')->get();
    }
    public function render()
    {


        $services = Service::with(['employer','customer','vehicle'])
            ->orWhereHas('employer',function ($q){
                $q->where('name','like',"%{$this->search}%");
            })
            ->orWhereHas('vehicle',function ($q){
                $q->where('license_plate','like',"%{$this->search}%");
            })
            ->orWhere('card_service','like',"%{$this->search}%")
            ->card($this->cardSearch)
            ->plate($this->plateSearch);

            if ($this->dateSearch){
                $fi = Carbon::parse($this->dateSearch)->format('Y-m-d');
                $services = $services->date($fi);
            }

//        if ($this->employer_id) {
//            $services = $services->emple($this->employer_id);
//        }

        if ($this->camp && $this->order) {
            $services = $services->orderBy($this->camp, $this->order);
        } else {
            $this->camp = null;
            $this->order = null;
        }

        $services = $services->paginate($this->perPage);
        return view('livewire.admin.service.live-service-table',compact('services'))
            ->extends('layouts.admin.app')->section('content');
    }

    //funcion para resetear variables
    public function clear()
    {
        $this->reset(['search',
            'cardSearch',
            'dateSearch',
            'plateSearch',
            'perPage',
            'camp',
            'order',
            'icon',
            'employer_id',
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
    public function deleteService(Service $service)
    {
        can('usuario delete');
        $service->delete();
    }
}

<?php

namespace App\Http\Livewire\Admin\Vehicle;

use App\Models\BrandVehicle;
use App\Models\ColorVehicle;
use App\Models\ImageVehicle;
use App\Models\TypeVehicle;
use App\Models\User;
use App\Models\Vehicle;
use DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class LiveVehicleTable extends Component
{
    use WithPagination;

    // Variables de busqueda
    public $search = '';
    public $plateSearch = '';
    public $modelSearch = '';

    public $perPage = 5;
    public $camp = null;
    public $order = null;
    public $icon = '-circle';

    public $color_id = null;
    public $customer_id = null;
    public $type_id = null;
    public $brand_id = null;

    //Variables de exportaciones
    public $selectedRows = [];
    public $selectPageRows = false;

    protected $listeners = [
        'vehicleListUpdate' => 'render',
        'delvehicle' => 'deleteVehicle'
    ];
    protected $paginationTheme = 'bootstrap';
    protected $queyString = [
        'search' => ['except' => ''],
        'order' => ['except' => null],
        'camp' => ['except' => null],
    ];

    public function list(){
        return view('vehicle.list');
    }

    public function mount(){
        $this->icon = $this->iconDirecction($this->order);

    }

    public function render()
    {
        $vehicles = Vehicle::termino($this->search)
            ->plate($this->plateSearch)
            ->model($this->modelSearch);

        // dd($products);
        if($this->customer_id){
            $vehicles = $vehicles->customer($this->customer_id);
        }
        if($this->color_id){
            $vehicles = $vehicles->color($this->color_id);
        }
        if($this->type_id){
            $vehicles = $vehicles->type($this->type_id);
        }
        if($this->brand_id){
            $vehicles = $vehicles->brand($this->brand_id);
        }
        if ($this->camp && $this->order) {
            $vehicles = $vehicles->orderBy($this->camp, $this->order);
        }else{
            $this->camp = null;
            $this->order = null;
        }

        $vehicles = $vehicles->paginate($this->perPage);

        // dd($vehicles);
        $customers = User::role('cliente')->get();
        $types = TypeVehicle::pluck('type_vehicle','id');
        $colors = ColorVehicle::pluck('color_vehicle','id');
        $brands = BrandVehicle::pluck('brand_vehicle','id');
        return view('livewire.admin.vehicle.live-vehicle-table',
            compact('vehicles','customers','colors','types','brands'))
            ->extends('layouts.admin.app')->section('content');
    }


    public function clear()
    {
        $this->reset();
    }

    public function updatingSearch(){
        $this->resetPage();
    }

    public function sortable($camp){
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
    public function iconDirecction($sort): string
    {
        if(!$sort){
            return '-sort';
        }
        return $sort === 'asc' ? '-sort-amount-down-alt' : '-sort-amount-down';
    }

    public function deleteVehicle(Vehicle $vehicle){
        can('usuario delete');
        $image_vehicle = ImageVehicle::where('vehicle_plate',$vehicle->license_plate)->get();
        if(!$image_vehicle){
            return ;
        }
        foreach ($image_vehicle as $img){
            if(Storage::disk('public')->exists('vehicle-photos/'.$img->image)){
                Storage::disk('public')->delete('vehicle-photos/'.$img->image);
            }
        }
        DB::table('image_vehicles')->where('vehicle_plate', $vehicle->license_plate)->delete();
        $vehicle->delete();
        $this->emit('successful_alert','Vehiculo eliminado con exito');
    }
}

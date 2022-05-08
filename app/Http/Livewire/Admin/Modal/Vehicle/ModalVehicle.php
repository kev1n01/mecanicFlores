<?php

namespace App\Http\Livewire\Admin\Modal\Vehicle;

use App\Http\Requests\RequestUpdateVehicle;
use App\Models\BrandVehicle;
use App\Models\ColorVehicle;
use App\Models\ImageVehicle;
use App\Models\TypeVehicle;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ModalVehicle extends Component
{
    use WithFileUploads;

    public $classModalDialog = '';
    public $classSize= 'modal-lg';
    public $idModal= 'VehicleModal';
    public $method = '';
    public $action = '';
    public $nameComponent = 'Vehiculos';

    public $target ;
    public $vehicleImg = null;

    public $customer_id = '';
    public $type_id = '';
    public $brand_id = '';
    public $color_id = '';
    public $license_plate = '';
    public $model_year = null;
    public $images = [];
    public $imagesUpdate= [];
    public $description = null;

    protected $listeners = ['toogleModalVehicle'];

    public function render()
    {
        $types = TypeVehicle::pluck('type_vehicle','id');
        $brands = BrandVehicle::where('type_vehicle_id',$this->type_id)->get();
        $colors = ColorVehicle::pluck('color_vehicle','id');
        $customers = User::role('cliente')->get();
        return view('livewire.admin.modal.vehicle.modal-vehicle',compact('types','brands','colors','customers'));
    }
    public function submit(){
        if($this->method == 'updateTarget'){
            $this->updateTarget();
        }else{
            $this->createTarget();
        }
    }
    public function clean(){
        $this->reset([
            '$target',
            '$vehicleImg',
            '$customer_id',
            '$type_id',
            '$brand_id',
            '$color_id',
            '$license_plate',
            '$model_year',
            '$images',
            '$imagesUpdate',
            '$description',
        ]);
    }
    public function cerrarModal(){
        $this->resetValidation();
        $this->resetErrorBag();
        $this->clean();
        $this->clearImages();
        $this->dispatchBrowserEvent('close-modal-vehicle');
    }
    public function toogleModalVehicle($model_id = null,$model= null){
        $this->resetValidation();
        $this->resetErrorBag();
        $this->clean();
        if($model_id && $model){
            $this->target = $model == 'Vehicle' ? Vehicle::find($model_id) : '';
            $this->license_plate = $this->target->license_plate;
            $this->customer_id = $this->target->customer_id;
            $this->type_id = $this->target->type_id;
            $this->brand_id = $this->target->brand_id;
            $this->color_id = $this->target->color_id;
            $this->model_year = $this->target->model_year;
            $this->description = $this->target->description;

            $this->vehicleImg = ImageVehicle::where('vehicle_plate',$this->license_plate)->get();
            foreach ($this->vehicleImg  as $img){
                array_push($this->imagesUpdate ,$img->image);
            }

            $this->action = 'Actualizar';
            $this->method = 'updateTarget';
        }else{

            $this->action = 'Registrar';
            $this->method = 'createTarget';
        }

        $this->dispatchBrowserEvent('open-modal-vehicle');
    }
    public function updateTarget(){
        $request = new RequestUpdateVehicle();
        $values = $this->validate($request->rules($this->target), $request->messages());

        $this->removeImage($this->imagesUpdate);

        foreach($this->images as $k => $image){
            $image = new ImageVehicle();
            $image->vehicle_plate = $this->license_plate;
            $nameimg = $this->license_plate . $k . '.' .$this->images[$k]->extension();
            $this->images[$k]->storeAs('public/vehicle-photos',$nameimg);
            $image->image = $nameimg;
            $image->save();
        }

        $this->target->update($values);
        $this->emit('vehicleListUpdate');
        $this->cerrarModal();
        $this->emit('successful_alert','Vehiculo actualizado correctamente');
    }

    public function updated($label){
        $request = new RequestUpdateVehicle();
        $this->validateOnly($label, $request->rules($this->target), $request->messages());
    }

    public function createTarget(){
        $request = new RequestUpdateVehicle();
        $values = $this->validate($request->rules($this->target), $request->messages());

        $vehicle = new Vehicle;
        $vehicle->fill($values);

        foreach($this->images as $k => $image){
            $vimage = new ImageVehicle();
            $vimage->vehicle_plate = $this->license_plate;
            $nameimg = $this->license_plate . $k . '.' .$this->images[$k]->extension();
            $this->images[$k]->storeAs('public/vehicle-photos',$nameimg);
            $vimage->image = $nameimg;
            $vimage->save();
        }

        $vehicle->save();
        $this->emit('vehicleListUpdate');
        $this->cerrarModal();
        $this->emit('successful_alert','Vehiculo guardado correctamente');

    }

    public function loadImage($images){

        foreach($images as $img){
            $location = Storage::disk('public')->put('vehicle-photos',$img);
        }
        return $location;
    }

    public function clearImages(){
        $this->images = [];
    }

    public function removeImage($images){
        if(!$images){
            return ;
        }

        foreach($images as $img){
            if(Storage::disk('public')->exists('vehicle-photos',$img)){
                Storage::disk('public')->delete('vehicle-photos',$img);
            }
        }
    }
}

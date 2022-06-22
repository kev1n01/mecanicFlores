<?php

namespace App\Http\Livewire\Admin\Modal\Provider;

use App\Http\Requests\UpdateProviderRequest;
use App\Models\Provider;
use App\Models\ProviderEstatus;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Livewire\TemporaryUploadedFile;
class ModalProvider extends Component
{
    use WithFileUploads;
    public $classModalDialog = '';
    public $classSize= 'modal-lg';
    public $idModal= 'ProviderModal';
    public $method = '';
    public $action = '';
    public $nameComponent = 'Proveedores';

    public $name;
    public $phone;
    public $address;
    public $ruc;
    public $name_company;
    public $image = null;
    public $image_url = null;

    public $providers = [];
    public $status = [];
    public $provider_status_id ;
    public $target;

    protected $listeners = ['toogleModalProvider'];
    public function hydrate(){
        $this->status = ProviderEstatus::pluck('name','id');
    }
    public function submit(){
        if($this->method == 'updateTarget'){
            $this->updateTarget();
        }else{
            $this->createTarget();
        }
    }
    public function render()
    {
        return view('livewire.admin.modal.provider.modal-provider');
    }
    public function clean(){
        $this->name = '';
        $this->phone = '';
        $this->address = '';
        $this->ruc = '';
        $this->name_company = '';
        $this->image = null;
        $this->image_url = null;
        $this->provider_status_id = '';
    }
    public function cerrarModal(){
        $this->resetValidation();
        $this->resetErrorBag();
        $this->clean();
        $this->dispatchBrowserEvent('close-modal');
    }
    public function toogleModalProvider($model_id = null,$model= null){
        $this->clean();
        $this->resetValidation();
        $this->resetErrorBag();
        if($model_id && $model){
            $this->target = $model == 'Provider' ? Provider::find($model_id) : '';
            $this->name = $this->target->name;
            $this->phone = $this->target->phone;
            $this->address = $this->target->address;
            $this->ruc = $this->target->ruc;
            $this->name_company = $this->target->name_company;
            $this->image_update = $this->target->image;
            $this->image_url = $this->target->image_provider;
            $this->provider_status_id = $this->target->provider_status_id;
            $this->action = 'Actualizar';
            $this->method = 'updateTarget';
        }else{
            $this->action = 'Registrar';
            $this->method = 'createTarget';
        }

        $this->dispatchBrowserEvent('open-modal');
    }
    public function updateTarget(){
        $request = new UpdateProviderRequest();
        $values = $this->validate($request->rules($this->target), $request->messages());

        if ($values['image']){
            $this->removeImage($this->target->image);
            $image = ['image' => $this->loadImage($values['image'])];
            $values = array_merge($values,$image);
        }

        $this->target->update($values);
        $this->emit('providerListUpdate');
        $this->cerrarModal();
        $this->emit('successful_alert','Proveedor actualizado correctamente');
    }
    public function createTarget(){
        $request = new UpdateProviderRequest();
        $values = $this->validate($request->rules($this->target), $request->messages());

        $provider = new Provider();
        $provider->fill($values);

        if ($values['image']) {
            $provider->image = $this->loadImage($values['image']);
        }

        $provider->save();
        $this->emit('providerListUpdate');
        $this->cerrarModal();
        $this->emit('successful_alert','Proveedor creado correctamente');
    }
    public function updated($label){
        $request = new UpdateProviderRequest();
        $this->validateOnly($label, $request->rules($this->target), $request->messages());
    }
    public function loadImage(TemporaryUploadedFile $image){
        $extension = $image->getClientOriginalExtension();

        $location = Storage::disk('public')->put('providers-photos',$image);
        return $location;
    }
    public function removeImage($image){
        if(!$image){
            return ;
        }

        if(Storage::disk('public')->exists($image)){
            Storage::disk('public')->delete($image);
        }
    }

}

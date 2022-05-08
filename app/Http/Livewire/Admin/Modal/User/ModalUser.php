<?php

namespace App\Http\Livewire\Admin\Modal\User;

use App\Http\Requests\RequestUpdateUse;
use App\Models\User;
use App\Models\UserEstatus;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\TemporaryUploadedFile;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;

class ModalUser extends Component
{
    use WithFileUploads;
    public $method = '';
    public $action = '';
    public $nameComponent = 'Usuarios';
    public $classModalDialog = '';
    public $classSize= 'modal-lg';
    public $idModal= 'UserModal';
    public $user = null;
    public $name = '';
    public $email = '';
    public $role = '';
    public $user_status_id = '';
    public $password = '';
    public $password_confirmation = '';
    public $profile_photo_path = null;
    public $profile_photo_url= null;
    public $roles = [];
    public $status = [];
    protected $listeners = [
        'showModal',
        'showModalNewUser',
    ];

    public function hydrate()
    {
        $this->roles = Role::pluck('name','name');
        $this->status = UserEstatus::pluck('name','id');
    }

    public function render()
    {
        return view('livewire.admin.modal.user.modal-user');
    }
    public function showModal(User $user){
        $this->clean();
        $this->resetValidation();
        $this->resetErrorBag();
        $this->user = $user;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->roles()->first()->name ?? '';
        $this->user_status_id = $user->user_status->id;
        $this->profile_photo_path_update = $user->profile_photo_path;
        $this->profile_photo_url = $user->profile_photo_url;
        $this->action = 'Actualizar';
        $this->method = 'actualizar';
        $this->dispatchBrowserEvent('open-modal');
    }
    public function showModalNewUser(){
        $this->clean();
        $this->resetValidation();
        $this->resetErrorBag();
        $this->user = null;
        $this->action = 'Registrar';
        $this->method = 'registrar';
        $this->dispatchBrowserEvent('open-modal');
    }
    public function clean(){
        $this->user = null;
        $this->name = '';
        $this->email = '';
        $this->profile_photo_path = null;
        $this->password = '';
        $this->password_confirmation = '';
        $this->role = '';
        $this->user_status_id = '';
    }

    public function cerrarModal(){
        $this->clean();
        $this->resetErrorBag();
        $this->resetValidation();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function submit(){
        if($this->method == 'actualizar'){
            $this->actualizar();
        }else{
            $this->registrar();
        }
    }

    public function actualizar(){
        $request = new RequestUpdateUse();
        $values = $this->validate($request->rules($this->user), $request->messages());

        $this->removeImage($this->user->profile_photo_path);

        if ($values['profile_photo_path']){
            $profile = ['profile_photo_path' => $this->loadImage($values['profile_photo_path'])];
            $values = array_merge($values,$profile);
        }

        $this->user->update($values);
        $this->user->syncRoles([$values['role']]);

        $this->cerrarModal();
        $this->emit('userListUpdate');
        $this->emit('successful_alert','usuario actualizado correctamente');
    }

    public function updated($label){
        $request = new RequestUpdateUse();
        $this->validateOnly($label, $request->rules($this->user), $request->messages());
    }

    public function registrar(){
        $request = new RequestUpdateUse();
        $values = $this->validate($request->rules($this->user), $request->messages());

        $user = new User;
        $user->fill($values);

        if ($values['profile_photo_path']) {
            $user->profile_photo_path = $this->loadImage($values['profile_photo_path']);
        }
        $user->assignRole($values['role']);
        $user->password = bcrypt($values['password']);

        $user->save();

        $this->cerrarModal();
        $this->emit('userListUpdate');
        $this->emit('successful_alert','usuario creado correctamente');
    }
    public function loadImage(TemporaryUploadedFile $image){

        $location = Storage::disk('public')->put('profile-photos',$image);
        return $location;
    }
    public function removeImage($profile_photo_path){
        if(!$profile_photo_path){
            return ;
        }

        if(Storage::disk('public')->exists($profile_photo_path)){
            Storage::disk('public')->delete($profile_photo_path);
        }
    }

}


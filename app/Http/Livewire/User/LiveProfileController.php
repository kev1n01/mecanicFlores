<?php

namespace App\Http\Livewire\User;

use App\Http\Requests\RequestUpdateCustomer;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Livewire\TemporaryUploadedFile;

class LiveProfileController extends Component
{
    use WithFileUploads;

    public $statepass = [
        'current_password' => '',
        'password' => '',
        'password_confirmation' => '',
    ];

    public $state = [
    ];

    public $photo;

    public function mount()
    {
        $this->state = Auth::user()->withoutRelations()->toArray();
        $this->profile_photo_path_update = $this->state['profile_photo_path'];
        $this->profile_photo_url = $this->state['profile_photo_url'];
        $this->name = $this->state['name'];
//        dd(  $this->profile_photo_path_update);
    }

    public function actualizar(UpdatesUserProfileInformation $updater)
    {
        $this->resetErrorBag();
        $updater->update(Auth::user(), $this->photo ? array_merge($this->state, ['photo' => $this->photo]) : $this->state
        );
        if (isset($this->photo)) {
            $this->mount();
        }
        $this->emit('successful_alert','Informacion guardado');
    }

    public function updatePassword(UpdatesUserPasswords $updater)
    {
        $this->resetErrorBag();
        $updater->update(Auth::user(), $this->statepass);

        $this->statepass = [
            'current_password' => '',
            'password' => '',
            'password_confirmation' => '',
        ];
        $this->emit('successful_alert','Contraseña actualizada');

    }

    public function deleteProfilePhoto()
    {
        Auth::user()->deleteProfilePhoto();
        $this->mount();
        $this->emit('successful_alert','Foto eliminado');

    }

    public function getUserProperty()
    {
        return Auth::user();
    }
    public function render()
    {
        return view('livewire.user.live-profile-controller')
            ->extends('layouts.user.app')->section('content');
    }

//
//    public $user = null;
//    public $name = '' ;
//    public $email = '' ;
//    public $ruc = '' ;
//    public $dni = '' ;
//    public $phone = '' ;
//    public $address = '' ;
//    public $password = '' ;
//    public $password_confirmation = '' ;
//    public $profile_photo_path = null;
//    public $profile_photo_url = null ;
//
//    public function mount(){
//        $this->user = User::find(Auth::user()->id);
//        $this->name = $this->user->name;
//        $this->email = $this->user->email;
//        $this->ruc = $this->user->ruc;
//        $this->dni = $this->user->dni;
//        $this->phone = $this->user->phone;
//        $this->address = $this->user->address;
//        $this->profile_photo_path_update = $this->user->profile_photo_path;
//        $this->profile_photo_url = $this->user->profile_photo_url;
//    }
//
//    public function updated($label){
//        $request = new RequestUpdateCustomer();
//        $this->validateOnly($label,$request->rules($this->user),$request->messages());
//    }
//
//    public function clean(){
//        $this->profile_photo_path = null;
//    }
//
//    public function actualizar(){
//        $request = new RequestUpdateCustomer();
//        $values = $this->validate($request->rules($this->user), $request->messages());
////        dd($this->user);
//        if($values['profile_photo_path']){
//            $this->removeImage($this->user->profile_photo_path);
//        }
//
//        if ($values['profile_photo_path']){
//            $profile = ['profile_photo_path' => $this->loadImage($values['profile_photo_path'])];
//            $values = array_merge($values,$profile);
//        }
//        $password = ['password' =>  Hash::make($values['password'])];
//        $values = array_merge($values,$password);
//        $this->user->save($values);
//        $this->resetValidation();
//        $this->resetErrorBag();
//        $this->mount();
//        $this->emit('successful_alert','Su información de cuenta se actualizó con éxito');
//    }
//    public function loadImage(TemporaryUploadedFile $image){
//
//        $location = Storage::disk('public')->put('profile-photos',$image);
//        return $location;
//    }
//    public function removeImage($profile_photo_path){
//        if(!$profile_photo_path ){
//            return ;
//        }
//
//        if(Storage::disk('public')->exists($profile_photo_path)){
//            Storage::disk('public')->delete($profile_photo_path);
//        }
//    }
}

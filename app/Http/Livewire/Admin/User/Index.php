<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\User;
use App\Models\UserEstatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;
use Livewire\{Component, WithPagination};
use Spatie\Permission\Models\Role;

class Index extends Component
{
    use WithPagination;
    public $search;
    public $nameSearch ='';
    public $emailSearch = '';
    public $perPage = 5;
    public $camp = null;
    public $order = null;
    public $icon = '-circle';
    public $user_role = '';
    public $user_status_id = '';
    public $roles = [];
    public $status = [];
    protected $listeners = ['userListUpdate' => 'render'];
    protected $paginationTheme = 'bootstrap';

    protected $queyString = [
        'search' => ['except' => ''],
        'order' => ['except' => null],
        'camp' => ['except' => null],
    ];

    // // public function hydrate(){
    // //     $this->roles = Role::pluck('name','name');
    // //     $this->status = UserEstatus::pluck('name','id');
    // // }
    public function mount(){
        $this->icon = $this->iconDirecction($this->order);
        $this->roles = Role::pluck('name','name');
        $this->status = UserEstatus::pluck('name','id');
    }

    public function render(){

        $users = User::termino($this->search)
        ->when($this->user_role != '',function($query){
            return $query->role($this->user_role );})
        ->name($this->nameSearch)
        ->email($this->emailSearch);

        if($this->user_status_id){
            $users = $users->status($this->user_status_id);
        }
        if ($this->camp && $this->order) {
            $users = $users->orderBy($this->camp, $this->order);
        }else{
            $this->camp = null;
            $this->order = null;
        }

        $users = $users->paginate($this->perPage);
        //retornar usuarios con tabla relacionado con with
        //$users=$users->with('nombre de funcion de relacion en el modelo User'(example:users_status))->paginate($this->perPage)
        //En la vista usar for $users as $user => $user->users_status->name
         
        return view('livewire.admin.user.index',['users' => $users])
                    ->extends('layouts.admin.app')->section('content');
    }

    public function clear(){
        // $this->reset();
        $this->search = '';
        $this->nameSearch = '';
        $this->emailSearch = '';
        $this->perPage = 5;
        $this->camp = null;
        $this->order = null;
        $this->icon = '-circle';
        $this->user_role = '';
        $this->user_status_id = '';
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


    public function showModal(User $user){
        if($user->name){
            can('usuario update');
            $this->emit('showModal',$user);
        }else{
            can('usuario create');
            $this->emit('showModalNewUser');
        }
    }
    public function deleteUser(User $user){
        can('usuario delete');
        $image_user = $user->image_user;
        if(!$image_user){
            return ;
        }
        if(Storage::disk('public')->exists($image_user)){
            Storage::disk('public')->delete($image_user);
        }

        $user->delete();
        $this->emit('successful_alert','Usuario eliminado correctamente');
    }
}

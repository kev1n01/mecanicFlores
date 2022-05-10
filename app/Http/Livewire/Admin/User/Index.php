<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\User;
use App\Models\UserEstatus;
use Illuminate\Support\Facades\Storage;
use Livewire\{Component, WithPagination};
use Spatie\Permission\Models\Role;
use App\Exports\UsersExport;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Maatwebsite\Excel\Excel;

class Index extends Component
{
    use WithPagination;
    // Variables de busqueda
    public $search = '';
    public $nameSearch ='';
    public $emailSearch = '';

    // Variables de paginado y orden
    public $perPage = 5;
    public $camp = null;
    public $order = null;
    public $icon = '-circle';

    // Variables de filtros
    public $user_role = '';
    public $user_status_id = '';
    public $roles = [];
    public $status = [];

    //Variables de exportaciones
    public $selectedRows = [];
	public $selectPageRows = false;

    protected $listeners = ['userListUpdate' => 'render', 'delUser'=>'deleteUser'];
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

        $this->usersRows = User::all();
    }
    public function render(){
        $users = User::termino($this->search)
        ->when($this->user_role != '',function($query){
            return $query->role($this->user_role);
        })
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

        // ->simplePaginate()->devuelve anterior siguiente
        //retornar usuarios con tabla relacionado con with
        //$users=$users->with('nombre de funcion de relacion en el modelo User'(example:users_status))->paginate($this->perPage)
        //En la vista usar for $users as $user => $user->users_status->name

        return view('livewire.admin.user.index',['users' => $users])
                    ->extends('layouts.admin.app')->section('content');
    }

    //funcion para resetear variables
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
    // funcion de livewire que actualiza una variable
    public function updatingSearch(){
        $this->resetPage(); //resetea a la primera página
    }
    // funcion para ordenar ascendente o descente los campos
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
    // funcion que controla la direccion de los iconos
    public function iconDirecction($sort): string{
        if(!$sort){
            return '-sort';
        }
        return $sort === 'asc' ? '-sort-amount-down-alt' : '-sort-amount-down';
    }
    // funcion que llama al modal de edicion o creacion de usuario
    public function showModal(User $user){
        if($user->name){
            can('usuario update');
            $this->emit('showModal',$user);
        }else{
            can('usuario create');
            $this->emit('showModalNewUser');
        }
    }
    // funcion que elimina un usuario
    public function deleteUser(User $user){
        can('usuario delete');
        $image_user = $user->image_user;
        if(!$image_user){
            return ;
        }
        if(Storage::disk('public')->exists($image_user)){//verifica si exite un archivo con la direccion en la carpeta public/storage
            Storage::disk('public')->delete($image_user);//elimina un archivo de la carpeta public/storage
        }

        $user->delete();
        $this->emit('successful_alert','El usuario '. $user->name .' eliminado correctamente');
    }

    //funcion para actualizar las filas seleccionados
    public function updatedSelectPageRows($value)
	{
		if ($value) {
			$this->selectedRows = $this->usersRows->pluck('id')
            ->map(function ($id) {
				return (string) $id;
			});
		} else {
			$this->reset(['selectedRows', 'selectPageRows']);
		}
	}

    //funcion para exportar por xlsx o pdf o csv las filas seleccionadas
    public function export($type)
    {
        if($type == 'excel'){
            return (new UsersExport($this->selectedRows))->download('usuarios.xlsx');
        }elseif($type == 'csv'){
            return (new UsersExport($this->selectedRows))->download('usuarios.csv', Excel::CSV);
        }else{
            return (new UsersExport($this->selectedRows))->download('usuarios.pdf', Excel::DOMPDF);
        }
    }

    public function pdfdownload(){
        $users = User::all();
        $pdf = PDF::loadView('exports.usersExport',compact('users'));
        return $pdf->download('Reporte-usuarios.pdf');
    }

    //funciona que elimina las filas seleccionadas
    public function deleteSelectedRows ()
    {
        User::whereIn('id', $this->selectedRows)->delete();
        $this->emit('successful_alert', 'Los usuarios seleccionados fueron eliminados');
        $this->reset( ['selectPageRows', 'selectedRows']);
    }


}

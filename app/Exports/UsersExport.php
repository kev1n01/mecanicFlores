<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersExport implements FromQuery, WithMapping, WithHeadings,ShouldAutoSize
{
    use Exportable;
    
    protected $selectedRows;
    
    public function __construct($selectedRows=[]){
        $this->selectedRows = $selectedRows;
    }
    

    public function map($user): array{
        return [
            $user->id,
            $user->name,
            $user->email,
            $user->user_status->name,
            $user->roles()->first()->name ?? 'Sin rol',
        ];
    }

    public function headings(): array {
        return [
            'Id',
            'Nombre',
            'Correo Electronico',
            'Estado',
            'Rol',
        ];
    }

    public function query(){
        if ($this->selectedRows) {
            return User::whereIn('id', $this->selectedRows);
        }else{
            return User::query();
        }


    }

}

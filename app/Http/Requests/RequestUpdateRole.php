<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestUpdateRole extends FormRequest
{
    public function authorize()
    {
        return false;
    }
    public function rules()
    {
        return [
                'role' => 'required|min:3|max:15|unique:roles,name',
        ];
    }

    public function messages(){
        return [
            'role.min' => 'El rol no debe tener menos de 3 caracteres',
            'role.max' => 'El rol no debe tener mas de 15 caracteres',
            'role.required' => 'El campo rol es obligatorio',
            'role.unique' => 'Ya existe un rol con este nombre',
            

        ];
    }
    
}

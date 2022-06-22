<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class RequestUpdateUse extends FormRequest
{

    public function authorize()
    {
        return false;
    }
    public function rules($user)
    {
        $roles = Role::pluck('name');
        $roles = $roles->join(',');
        $values =[
            'name' => 'required|min:3|max:30',
            'email' => ['required','email',Rule::unique('users','email')->ignore($user)],
            'role' => "required|in:{$roles}",
            'user_status_id' => 'required',
            'profile_photo_path' => 'nullable|image|mimes:jpg,png,jpge'
        ];

        if(!$user){
            $validation_pass = [
                'password' => 'required|confirmed'
            ];

            $values = array_merge($values,$validation_pass);

        }
        return $values;

    }
    public function messages(){
        return [
            'name.min' => 'El nombre no debe tener menos de 3 caracteres',
            'name.max' => 'El nombre no debe tener mas de 30 caracteres',
            'name.required' => 'El campo nombre es obligatorio',
            'email.required' => 'El campo email es obligatorio',
            'email.email' => 'El email ingresado no es válido',
            'role.required' => 'El campo rol es obligatorio',
            'password.required' => 'El campo contraseña es obligatorio',
            'password.confirmed' => 'El campo no coincide con confirmar contraseña',
            'profile_photo_path.image' => 'El campo solo permite imagenes',
            'profile_photo_path.mimes' => 'Solo se acepta formatos jpg, png',
            'user_status_id.required' => 'El estado es requerido',

        ];
    }
}

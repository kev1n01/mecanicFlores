<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RequestUpdateCustomer extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }
    public function rules($user)
    {
        $values =[

            'name' => 'required|min:5|max:15',
            'email' => ['required','email',Rule::unique('users','email')->ignore($user)],
            'ruc' => ['nullable','min:11','max:11',Rule::unique('users','ruc')->ignore($user)],
            'dni' => ['required','min:8','max:8',Rule::unique('users','dni')->ignore($user)],
            'phone' => ['required','min:9','max:9',Rule::unique('users','phone')->ignore($user)],
            'address' => ['required','min:10','max:30',Rule::unique('users','address')->ignore($user)],
            'password' => 'nullable|confirmed',
            'profile_photo_path' => 'nullable|image|mimes:jpg,png,jpge',
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
            'name.min' => 'El nombre no debe tener menos de 5 caracteres',
            'name.max' => 'El nombre no debe tener mas de 15 caracteres',
            'name.required' => 'El campo nombre es obligatorio',
            'email.required' => 'El campo email es obligatorio',
            'email.email' => 'El email ingresado no es válido',
//            'password.required' => 'El campo contraseña es obligatorio',
            'password.confirmed' => 'El campo no coincide con confirmar contraseña',
            'profile_photo_path.image' => 'El campo solo permite imagenes',
            'profile_photo_path.mimes' => 'Solo se acepta formatos jpg, png y jpge',
            'ruc.min' => 'El ruc no debe tener menos de 11 caracteres',
            'ruc.max' => 'El ruc no debe tener más de 11 caracteres',
            'dni.required' => 'El campo dni es obligatorio',
            'dni.min' => 'El dni no debe tener menos de 8 caracteres',
            'dni.max' => 'El dni no debe tener más de 8 caracteres',
            'phone.required' => 'El campo celular es obligatorio',
            'phone.min' => 'El celular no debe tener menos de 9 caracteres',
            'phone.max' => 'El celular no debe tener más de 9 caracteres',
            'address.required' => 'La dirección celular es obligatorio',
            'address.min' => 'La dirección no debe tener menos de 10 caracteres',
            'address.max' => 'La dirección no debe tener más de 30 caracteres',

        ];
    }
}

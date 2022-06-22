<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class UpdateProviderRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules($provider)
    {
        return [
            'name' => ['required','min:5','max:30',Rule::unique('providers','name')->ignore($provider)],
            'address' => ['nullable','min:5','max:40',Rule::unique('providers','address')->ignore($provider)],
            'phone' => ['required','min:9','max:12',Rule::unique('providers','phone')->ignore($provider)],
            'ruc' => ['required','min:11','max:11',Rule::unique('providers','ruc')->ignore($provider)],
            'name_company' => ['nullable','min:5','max:20',Rule::unique('providers','name_company')->ignore($provider)],
            'provider_status_id' => ['required'],
            'image' => 'nullable|image'
        ];

    }
    public function messages(){
        return [
            'name.min' => 'El nombre no debe tener menos de 5 caracteres',
            'name.max' => 'El nombre no debe tener más de 30 caracteres',
            'name.required' => 'El nombre es requerido',
            'name.unique' => 'Ya existe un proveedor con el mismo nombre',

            'address.min' => 'La direccion no debe tener menos de 5 caracteres',
            'address.max' => 'La direccion no debe tener más de 40 caracteres',
            'address.unique' => 'Ya existe un proveedor con esta dirección',

            'phone.min' => 'El número telefónico no debe tener menos de 9 caracteres',
            'phone.max' => 'El número telefónico no debe tener más de 12 caracteres',
            'phone.required' => 'El número es requerido',
            'phone.unique' => 'Ya existe un proveedor con este número telefónico',

            'ruc.min' => 'El número ruc no debe tener menos de 11 caracteres',
            'ruc.max' => 'El número ruc no debe tener más de 11 caracteres',
            'ruc.required' => 'El número ruc es requerido',
            'ruc.unique' => 'Ya existe un proveedor con este número ruc ',

            'name_company.min' => 'El nombre compañia no debe tener menos de 5 caracteres',
            'name_company.max' => 'El nombre compañia no debe tener más de 20 caracteres',
            'name_company.unique' => 'Ya existe un proveedor con este nombre compañia ',

            'provider_status_id.required' => 'El estado es requerido',

            'image.image' => 'El campo solo permite imagenes',
        ];
    }
}

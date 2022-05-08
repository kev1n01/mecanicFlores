<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class RequestUpdateVehicle extends FormRequest
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

    public function rules($vehicle)
    {
        return [
            'license_plate' => ['required','regex:/^[A-Z0-9][\[A-Z\-0-9\]]*$/u','min:6','max:6',Rule::unique('vehicles','license_plate')->ignore($vehicle)],
            'description' => 'nullable|max:30',
            'model_year' => 'nullable',
            'customer_id' => 'required',
            'brand_id' => 'required',
            'color_id' => 'required',
            'type_id' => 'required',
            'images.*' => 'nullable'
        ];
    }

    public function messages()
    {
        return [
            'customer_id.required' => 'El cliente en requerido',
            'brand_id.required' => 'La marca de vehiculo es requerido',
            'color_id.required' => 'El color de vehiculo es requerido',
            'type_id.required' => 'El tipo de vehiculo es requerido',

            'license_plate.required' => 'La placa es requerido',
            'license_plate.regex' => 'La placa solo acepta mayusculas',
            'license_plate.min' => 'La placa debe tener minimo 6 caracteres',
            'license_plate.max' => 'La placa debe tener maximo 6 caracteres',
            'license_plate.unique' => 'Esta placa ya ha sido registrado',

            'description.max' => 'No debe tener más de 30 caracteres',

            'images.mimes' => 'Solo se aceptan png,jpg,jpeg'
        ];
    }
}

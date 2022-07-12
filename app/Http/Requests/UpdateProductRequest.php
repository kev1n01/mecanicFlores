<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
{

    public function authorize()
    {
        return false;
    }

    public function rules($product)
    {
        return [
            'name' => ['required', 'min:5', 'max:30', Rule::unique('products', 'name')->ignore($product)],
            'code' => ['nullable', 'min:14', 'max:14', Rule::unique('products', 'code')->ignore($product)],
            'stock' => 'nullable|integer',
            'sale_price' => 'nullable|numeric|regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/',
            'purchase_price' => 'nullable|numeric|regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/',
            'unit' => 'nullable',
            'product_status_id' => 'required',
            'category_product_id' => 'required',
            'brand_product_id' => 'required',
            'image_product' => 'nullable|image'
        ];

    }

    public function messages()
    {
        return [
            'name.min' => 'El nombre no debe tener menos de 5 caracteres',
            'name.max' => 'El nombre no debe tener más de 30 caracteres',
            'name.required' => 'El nombre es requerido',
            'name.unique' => 'Ya existe un producto con el mismo nombre',

            'stock.integer' => 'El stock tiene que ser un número entero',

            'code.min' => 'El código de barra no debe tener menos de 14 caracteres',
            'code.max' => 'El código de barra no debe tener más de 14 caracteres',
            'code.required' => 'El código de barra es requerido',
            'code.unique' => 'Ya existe un producto con este código de barra',


            'sale_price.numeric' => 'El precio venta tiene que ser entero o decimal',
            'sale_price.regex' => 'El formato decimal de precio es incorrecto',

            'purchase_price.regex' => 'El formato decimal de precio es incorrecto',
            'purchase_price.numeric' => 'El precio compra tiene que ser entero o decimal',

            'category_product_id.required' => 'La categoria es requerido',
            'brand_product_id.required' => 'El marca es requerido',
            'product_status_id.required' => 'El estado es requerido',

            'image_product.image' => 'El campo solo permite jpg,jpge,png',

        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateReserveRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'place' => 'required|string',
            'fecha' => 'required|date',
            'cost' => 'required|numeric',
            'unidad' => 'required|numeric|min:1|max:100',
        ];
    }
    /**
     * Definición de los mensajes de validación.
     *
     * @return array
     */
    public function messages()
    {
        // Se espeficican los mensajes de validación para las reglas definidas
        // en el método rules de esta clase.
        return [
            'place.required' => 'Es necesario completar el campo lugar',
            'place.string' => 'El lugar debe contener datos',
            'fecha.required' => 'Es necesario completar el campo fecha',
            'fecha.string' => 'La fecha deben ser datos',
            'cost.required' => 'Es necesario completar el campo precio',
            'cost.numeric' => 'El precio debe contener numeros',
            'unidad.required' => 'Es necesario completar el campo unidad',
            'unidad.numeric' => 'La unidad debe contener numeros',
            'unidad.min' => 'El valor minimo es 1 para unidad',
            'unidad.max' => 'El valor maximo es 100 para unidad'
        ];
    }
}
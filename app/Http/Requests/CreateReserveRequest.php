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
            'place' => 'required|numeric|min:1',
            'fecha' => 'required|date',
            'cost' => 'required|numeric|min:0|max:50',
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
            'place.numeric' => 'El lugar debe contener numeros',
            'place.min' => 'El valor minimo es 1 para lugar',
            'fecha.required' => 'Es necesario completar el campo fecha',
            'fecha.string' => 'La fecha deben ser datos',
            'cost.required' => 'Es necesario completar el campo precio',
            'cost.numeric' => 'El precio debe contener numeros',
            'cost.min' => 'El valor minimo es 0 para precio',
            'cost.max' => 'El valor maximo es 50 para precio',
            'unidad.required' => 'Es necesario completar el campo unidad',
            'unidad.numeric' => 'La unidad debe contener numeros',
            'unidad.min' => 'El valor minimo es 1 para unidad',
            'unidad.max' => 'El valor maximo es 100 para unidad'
        ];
    }
}
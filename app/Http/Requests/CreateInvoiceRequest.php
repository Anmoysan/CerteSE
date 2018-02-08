<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateInvoiceRequest extends FormRequest
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
            'date' => 'required|date',
            'cost' => 'required|numeric|min:0|max:50',
            'units' => 'required|numeric|min:1|max:100',
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
            'date.required' => 'Es necesario completar el campo fecha',
            'date.string' => 'La fecha deben ser datos',
            'cost.required' => 'Es necesario completar el campo precio',
            'cost.numeric' => 'El precio debe contener numeros',
            'cost.min' => 'El valor minimo es 0 para precio',
            'cost.max' => 'El valor maximo es 50 para precio',
            'units.required' => 'Es necesario completar el campo unidad',
            'units.numeric' => 'La unidad debe contener numeros',
            'units.min' => 'El valor minimo es 1 para unidad',
            'units.max' => 'El valor maximo es 100 para unidad'
        ];
    }
}

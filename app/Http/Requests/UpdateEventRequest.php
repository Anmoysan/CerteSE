<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
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
            'name' => 'nullable|string|max:30',
            'image' => 'nullable',
            'place' => 'nullable|numeric|min:1',
            'date' => 'nullable|date',
            'duration' => 'nullable',
            'cost' => 'nullable|numeric|min:0|max:50',
            'agemin' => 'nullable|numeric|min:0|max:80',
            'organizer' => 'nullable|string|max:50',
            'commentarys' => 'nullable|boolean',
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
            'name.max' => 'Has sobrepasado los 30 caracteres disponibles para el nombre',
            'name.string' => 'El nombre debe contener caracteres',
            'place.numeric' => 'Debe seleccionar un lugar',
            'place.min' => 'El valor minimo es 0 para precio',
            'date.date' => 'La fecha deben ser formato fecha',
            'date.min' => 'La fecha minima para un evento es el dia de mañana',
            'cost.numeric' => 'El precio debe contener numeros',
            'cost.min' => 'El valor minimo es 0 para precio',
            'cost.max' => 'El valor maximo es 50 para precio',
            'agemin.numeric' => 'La edad debe contener numeros',
            'agemin.min' => 'El valor minimo es 0 para edad',
            'agemin.max' => 'El valor maximo es 18 para edad',
            'organizer.max' => 'Has sobrepasado los 50 caracteres disponibles para el organizador',
            'organizer.string' => 'El organizador debe contener caracteres',
            'commentarys.boolean' => 'Debe elegir si quiere o no comentarios'
        ];
    }
}

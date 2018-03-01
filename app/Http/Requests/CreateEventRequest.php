<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEventRequest extends FormRequest
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
            'name' => 'required|string|max:30',
            'place' => 'required|numeric|min:1',
            'subject' => 'required|string|max:100',
            'date' => 'required|date',
            'duration' => 'required',
            'cost' => 'required|numeric|min:0|max:50',
            'agemin' => 'required|numeric|min:0|max:80',
            'organizer' => 'required|string|max:50',
            'commentarys' => 'required|boolean',
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
            'name.required' => 'Es necesario completar el campo nombre',
            'name.max' => 'Has sobrepasado los 30 caracteres disponibles para el nombre',
            'name.string' => 'El nombre debe contener caracteres',
            'place.required' => 'Es necesario completar el campo lugar',
            'place.numeric' => 'Debe seleccionar un lugar',
            'place.min' => 'El valor minimo es 0 para precio',
            'subject.required' => 'Es necesario completar el campo tema',
            'subject.max' => 'Has sobrepasado los 100 caracteres disponibles para el tema',
            'subject.string' => 'El tema debe contener caracteres',
            'date.required' => 'Es necesario completar el campo fecha',
            'date.date' => 'La fecha deben ser formato fecha',
            'date.min' => 'La fecha minima para un evento es el dia de mañana',
            'duration.required' => 'Es necesario completar el campo duracion',
            'cost.required' => 'Es necesario completar el campo precio',
            'cost.numeric' => 'El precio debe contener numeros',
            'cost.min' => 'El valor minimo es 0 para precio',
            'cost.max' => 'El valor maximo es 50 para precio',
            'agemin.required' => 'Es necesario completar el campo edad',
            'agemin.numeric' => 'La edad debe contener numeros',
            'agemin.min' => 'El valor minimo es 0 para edad',
            'agemin.max' => 'El valor maximo es 18 para edad',
            'organizer.required' => 'Es necesario completar el campo organizador',
            'organizer.max' => 'Has sobrepasado los 50 caracteres disponibles para el organizador',
            'organizer.string' => 'El organizador debe contener caracteres',
            'commentarys.required' => 'Es necesario completar si quieres comentarios',
            'commentarys.boolean' => 'Debe elegir si quiere o no comentarios'
        ];
    }
}
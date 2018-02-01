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
            'image' => 'required|string|max:255',
            'latitud' => 'required|numeric|min:-85|max:85',
            'longitud' => 'required|numeric|min:-180|max:180',
            'subject' => 'required|string|max:100',
            'date' => 'required|date',
            'duration' => 'required',
            'cost' => 'required|numeric|min:0|max:50',
            'agemin' => 'required|numeric|min:0|max:18',
            'organizer' => 'required|string|max:50',
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
            'image.required' => 'Es necesario completar el campo imagen',
            'image.max' => 'Has sobrepasado los 255 caracteres disponibles para el imagen',
            'image.string' => 'La imagen debe contener caracteres',
            'latitud.required' => 'Es necesario completar el campo latitud',
            'latitud.numeric' => 'La latitud debe contener numeros',
            'latitud.min' => 'El valor minimo es -85 para latitud',
            'latitud.max' => 'El valor maximo es 85 para latitud',
            'longitud.required' => 'Es necesario completar el campo longitud',
            'longitud.numeric' => 'La longitud debe contener numeros',
            'longitud.min' => 'El valor longitud es -180 para latitud',
            'longitud.max' => 'El valor longitud es 180 para latitud',
            'subject.required' => 'Es necesario completar el campo tema',
            'subject.max' => 'Has sobrepasado los 100 caracteres disponibles para el tema',
            'subject.string' => 'El tema debe contener caracteres',
            'date.required' => 'Es necesario completar el campo fecha',
            'date.string' => 'La fecha deben ser datos',
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
        ];
    }
}
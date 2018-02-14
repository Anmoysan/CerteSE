<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePlaceRequest extends FormRequest
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
            'name' => 'required|string|max:60',
            'image' => 'required|image|string|max:255',
            'description' => 'required|string|min:10|max:255',
            'latitud' => 'required|numeric|min:-85|max:85',
            'longitud' => 'required|numeric|min:-180|max:180'
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
            'name.max' => 'Has sobrepasado los 60 caracteres disponibles para el nombre',
            'name.string' => 'El nombre debe contener caracteres',
            'image.required' => 'Es necesario completar el campo imagen',
            'image.image' => 'El campo imagen debe contener un archivo de tipo .jpg, jpeg, png, bmp, gif, o svg',
            'image.max' => 'Has sobrepasado los 255 caracteres disponibles para el imagen',
            'image.string' => 'La imagen debe contener caracteres',
            'description.required' => 'Es necesario completar el campo descripcion',
            'description.min' => 'No has sobrepasado los 10 caracteres disponibles para la descripcion',
            'description.max' => 'Has sobrepasado los 255 caracteres disponibles para la descripcion',
            'description.string' => 'La descripcion debe contener caracteres',
            'latitud.required' => 'Es necesario completar el campo latitud',
            'latitud.numeric' => 'La latitud debe contener numeros',
            'latitud.min' => 'El valor minimo es -85 para latitud',
            'latitud.max' => 'El valor maximo es 85 para latitud',
            'longitud.required' => 'Es necesario completar el campo longitud',
            'longitud.numeric' => 'La longitud debe contener numeros',
            'longitud.min' => 'El valor longitud es -180 para latitud',
            'longitud.max' => 'El valor longitud es 180 para latitud'
        ];
    }
}

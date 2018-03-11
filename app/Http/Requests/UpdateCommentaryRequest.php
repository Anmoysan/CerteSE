<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCommentaryRequest extends FormRequest
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
    public function rules()
    {
        return [
            'content' => 'nullable|string|min:3|max:255',
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
            'content.string' => 'El contenido debe contener numeros',
            'content.min' => 'El minimo tamaño para contenido es de 3 caracteres',
            'content.max' => 'El maximo tamaño para contenido es de 255 caracteres'
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateVoteRequest extends FormRequest
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
            'vote' => 'required|numeric|min:1|max:5',
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
            'vote.required' => 'Es necesario completar el campo voto',
            'vote.numeric' => 'El voto debe contener numeros',
            'vote.min' => 'El valor minimo es 1 para voto',
            'vote.max' => 'El valor maximo es 5 para voto'
        ];
    }
}

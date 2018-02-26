<?php

namespace App\Http\Requests;

use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class CreateReserveFormAjaxRequest extends CreateReserveAjaxRequest
{
    public function rules()
    {

        $rules = array();

        if($this->exists('place')){
            $rules['place'] = $this->validatePlace();
        }

        if($this->exists('fecha')) {
            $rules['fecha'] = $this->validateDate();
        }

        if($this->exists('unidad')) {
            $rules['unidad'] = $this->validateUnits();
        }

        if($this->exists('cost')) {
            $rules['cost'] = $this->validateCost();
        }

        return $rules;
    }


    protected function failedValidation($validator)
    {
        $errors = $validator->errors();
        $response = new JsonResponse([
            'place' => $errors->get('place'),
            'fecha' => $errors->get('fecha'),
            'unidad' => $errors->get('unidad'),
            'cost' => $errors->get('cost'),

        ]);

        throw new ValidationException($validator, $response);
    }
}

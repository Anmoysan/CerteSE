<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateReserveAjaxRequest extends FormRequest
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
        $rules = array();

        $rules['place'] = $this->validatePlace();
        $rules['fecha'] = $this->validateDate();
        $rules['cost'] = $this->validateCost();
        $rules['unidad'] = $this->validateUnits();

        return $rules;
    }

    public function messages()
    {
        $errorPlace = $this->errorPlace();
        $errorDate = $this->errorDate();
        $errorCost = $this->errorCost();
        $errorUnits = $this->errorUnits();

        $errors = array_merge(
            $errorPlace,
            $errorDate,
            $errorCost,
            $errorUnits
        );

        return $errors;
    }

    protected function validatePlace(){
        return 'required|string';
    }

    protected function errorPlace(){
        $errors = array();

        $error["place.required"] = 'Es necesario completar el campo lugar';
        $error["place.string"] = 'El lugar debe contener cadena de caracteres';

        return $errors;
    }

    protected function validateDate(){
        return 'required|string';
    }

    protected function errorDate(){
        $errors = array();

        $error["fecha.required"] = 'Es necesario completar el campo lugar';
        $error["fecha.string"] = 'El lugar debe contener cadena de caracteres';

        return $errors;
    }

    protected function validateCost(){
        return 'required|numeric|min:0|max:50';
    }

    protected function errorCost(){
        $errors = array();

        $error["cost.required"] = 'Es necesario completar el campo precio';
        $error["cost.numeric"] = 'El precio debe contener numeros';
        $error["cost.min"] = 'El valor minimo es 0 para precio';
        $error["cost.max"] = 'El valor maximo es 50 para precio';

        return $errors;
    }

    protected function validateUnits(){
        return 'required|numeric|min:1|max:100';
    }

    protected function errorUnits(){
        $errors = array();

        $error["unidad.required"] = 'Es necesario completar el campo unidad';
        $error["unidad.numeric"] = 'La unidad debe contener numeros';
        $error["unidad.min"] = 'El valor minimo es 1 para unidad';
        $error["unidad.max"] = 'El valor maximo es 100 para unidad';

        return $errors;
    }




}

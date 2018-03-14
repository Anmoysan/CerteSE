<?php

namespace App\Http\Requests;

use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class CreateUserFormAjaxRequest extends CreateUserAjaxRequest
{
    public function rules()
    {

        $rules = array();

        if($this->exists('name')){
            $rules['name'] = $this->validateName();
        }

        if($this->exists('lastname')) {
            $rules['lastname'] = $this->validateLastname();
        }

        if($this->exists('username')) {
            $rules['username'] = $this->validateUsername();
        }

        if($this->exists('email')) {
            $rules['email'] = $this->validateEmail();
        }

        return $rules;
    }


    protected function failedValidation($validator)
    {
        $errors = $validator->errors();
        $response = new JsonResponse([
            'name' => $errors->get('name'),
            'lastname' => $errors->get('lastname'),
            'username' => $errors->get('username'),
            'email' => $errors->get('email')

        ]);

        throw new ValidationException($validator, $response);
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserAjaxRequest extends FormRequest
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

        $rules['name'] = $this->validateName();
        $rules['lastname'] = $this->validateLastname();
        $rules['username'] = $this->validateUsername();
        $rules['email'] = $this->validateEmail();

        return $rules;
    }

    public function messages()
    {
        $errorName = $this->errorName();
        $errorLastname = $this->errorLastname();
        $errorUsername = $this->errorUsername();
        $errorEmail = $this->errorEmail();

        $errors = array_merge(
            $errorName,
            $errorLastname,
            $errorUsername,
            $errorEmail
        );

        return $errors;
    }

    protected function validateName(){
        return 'required|alpha|string|max:30';
    }

    protected function errorName(){
        $errors = array();

        $error["name.required"] = 'El nombre es obligatorio.';
        $error["name.string"] = 'El nombre debe ser una cadena de caracteres';
        $error["name.alpha"] = 'El nombre solo puede contener letras.';
        $error["name.max"] = 'El nombre debe tener 30 caracteres como maximo';

        return $errors;
    }

    protected function validateLastname(){
        return 'required|alpha|string|max:60';
    }

    protected function errorLastname(){
        $errors = array();

        $error["lastname.required"] = 'Los apellidos es obligatorio.';
        $error["lastname.string"] = 'Los apellidos deben ser una cadena de caracteres';
        $error["lastname.alpha"] = 'Los apellidos solo puede contener letras.';
        $error["lastname.max"] = 'Los apellidos tener tener 60 caracteres como maximo';

        return $errors;
    }

    protected function validateUsername(){
        return 'required|string|max:30|unique:users';
    }

    protected function errorUsername(){
        $errors = array();

        $error["username.required"] = 'El nick es obligatorio.';
        $error["username.string"] = 'El nick debe ser una cadena de caracteres';
        $error["username.max"] = 'El nick puede tener 30 caracteres como maximo';
        $error["username.unique"] = 'El nick ya existe.';

        return $errors;
    }

    protected function validateEmail(){
        return 'required|max:100|email';
    }

    protected function errorEmail(){
        $errors = array();

        $error["email.required"] = 'El email es obligatorio.';
        $error["email.email"] = 'El email debe ser una cadena de caracteres';
        $error["email.max"] = 'El email tener tener 255 caracteres como maximo';

        return $errors;
    }
}

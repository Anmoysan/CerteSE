<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        $path = $this->path();

        if (strpos($path, 'account')){
            $rules = [
                'name' => 'nullable|alpha|string|max:30',
                'lastname' => 'nullable|alpha|string|max:60',
                'username' => 'nullable|string|max:30|unique:users',
                'mobileCountry' => 'nullable|numeric|min:1|max:999',
                'mobileNumber' => 'nullable|numeric|min:600000000|max:999999999',
                'biography' => 'nullable|string|max:300|min:4',
                'website' => 'nullable|string|max:100|min:7'
            ];
        }elseif (strpos($path, 'password')){
            $rules = [
                'current_password' => 'required|string|min:6',
                'password' => 'required|string|min:6|confirmed',
            ];
        }elseif (strpos($path, 'avatar')){
            $rules = [
                'avatar' => 'required|image',
            ];
        }

        return $rules;
    }
}

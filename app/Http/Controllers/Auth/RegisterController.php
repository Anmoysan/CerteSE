<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|alpha|string|max:30',
            'lastname' => 'required|alpha|string|max:60',
            'username' => 'required|string|max:30|unique:users',
            'email' => 'required|max:100|email',
            'password' => 'required|min:8|max:100|confirmed',
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'name.alpha' => 'El nombre solo puede contener letras.',
            'name.string' => 'El nombre debe ser una cadena de caracteres',
            'name.max' => 'El nombre debe tener 30 caracteres como maximo',
            'lastname.required' => 'Los apellidos es obligatorio.',
            'lastname.alpha' => 'Los apellidos solo puede contener letras.',
            'lastname.string' => 'Los apellidos deben ser una cadena de caracteres',
            'lastname.max' => 'Los apellidos tener tener 60 caracteres como maximo',
            'username.required' => 'El nick es obligatorio.',
            'username.string' => 'El nick debe ser una cadena de caracteres',
            'username.max' => 'El nick puede tener 30 caracteres como maximo',
            'username.unique' => 'El nick ya existe.',
            'email.required' => 'El email es obligatorio.',
            'email.email' => 'El email debe ser una cadena de caracteres',
            'email.max' => 'El email tener tener 255 caracteres como maximo',
            'password.required' => 'La contraseña es obligatorio.',
            'password.string' => 'La contraseña debe ser una cadena de caracteres',
            'password.max' => 'La contraseña debe tener 100 caracteres como maximo',
            'password.min' => 'La contraseña debe tener 8 caracteres como minimo',
            'password.confirmed' => 'Las contraseñas no coinciden',
        ]);
    }

    /** Validacion por Ajax con FormRquest
     * @param CreateUserAjaxFormRequest $request
     * @return array
     */
    protected function validacionAjax(CreateUserAjaxFormRequest $request){
        //Obtenermos todos los valores y devolvemos un array vacio
        return array();
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'lastname' => $data['lastname'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'avatar' => "http://panamapoesia.com/image/SinFoto.png",
            'ban' => false,
            'timeban' => 0,
        ]);
    }
}

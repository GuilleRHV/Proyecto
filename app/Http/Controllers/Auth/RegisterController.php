<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = RouteServiceProvider::HOME;

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
            'name' => ['required', 'string', 'max:20'],
            'apellido' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:30', 'unique:usuarios'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ],[
            'name.required' => "El nombre es obligatorio",
            'name.string' => "El nombre debe ser una cadena",
            'name.max' => "El nombre debe tener un maximo de 20",
            'apellido.required'=>"El apellido es obligatorio",
            "apellido.string" => "El apellido debe ser una cadena",
            'apellido.max' => "El apellido debe tener un maximo de 20 caracteres",
            "email.required"=>"El email es obligatorio",
            "email.string" => "El email debe ser una cadena",
            "email.email" => "El email debe estar bien compuesto: nombre@dominio.(ej: com)",
            "email.confirmed"=>"El email es obligatorio",
            "email.unique"=>"Ya existe alguien registrado con esta direccion de email",
            "email.max" => "El email debe tener un maximo de 30 caracteres",
            "password.required"=>"La contraseña es obligatoria",
            "password.string" => "La contraseña debe ser una cadena",
            "password.min" => "La contraseña debe tener como minimo 8 caracteres",
            "password.confirmed"=>"Las contraseñas deben coincidir" 
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'apellido'=>$data['apellido'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'rol'=>"usuario",
            'imagen'=>'imagenesperfil/userdefault.png'
        ]);
    }
}

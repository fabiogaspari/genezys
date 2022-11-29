<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Address;
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'address.cep' => ['required', 'string', 'min:8', 'max:9'],
            'address.street' => ['required', 'string', 'min:1'],
            'address.neighborhood' => ['required', 'string', 'min:1'],
            'address.number' => ['required','string'],
            'address.state' => ['required', 'string', 'size:2'],
            'address.city' => ['required', 'string', 'min:1'],
        ],
        [
            'name.required' => 'O campo nome é obrigatório',
            'email.required' => 'O campo email é obrigatório',
            'password.required' => 'O campo password é obrigatório',
            'address.cep.required' => 'O campo CEP é obrigatório',
            'address.street.required' => 'O campo rua é obrigatório',
            'address.neighborhood.required' => 'O campo bairro é obrigatório',
            'address.number.required' => 'O campo número é obrigatório',
            'address.state.required' => 'O campo estado é obrigatório',
            'address.city.required' => 'O campo cidade é obrigatório',
            'name.max' => 'O campo nome deve ter no máximo 255 caracteres',
            'email.max' => 'O campo email deve ter no máximo 255 caracteres',
            'password.min' => 'O campo password deve ter no minimo 8 caracteres',
            'address.cep.size' => 'O campo CEP deve ter 8 caracteres',
            'address.street.min' => 'O campo rua deve ter no minimo 1 caracteres',
            'address.neighborhood.min' => 'O campo bairro deve ter no minimo 1 caracteres',
            'address.state.size' => 'O campo estado deve ter no 2 caracteres',
            'address.city.min' => 'O campo cidade deve ter no minimo 1 caracteres',
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
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        $user = $user->refresh();
        Address::create([
            'cep' => $data['address']['cep'],
            'street' => $data['address']['street'],
            'neighborhood' => $data['address']['neighborhood'],
            'number' => $data['address']['number'],
            'state' => $data['address']['state'],
            'city' => $data['address']['city'],
            'user_id' => $user->id
        ]);
        
        return $user;
    }
}

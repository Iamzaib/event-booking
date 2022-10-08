<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\User;
use App\Providers\RouteServiceProvider;
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
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    public function showRegistrationForm()
    {
        $data['cities']=$data['states']= [''=>trans('global.pleaseSelect')];

        $data['countries'] = Country::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        return view('auth.register',$data);
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'     => ['required', 'string', 'max:255'],
            'lastname' => [
                'string',
                'nullable',
            ],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'phone' => [
                'string',
                'required',
                'unique:users',
            ],
            'address' => [
                'string',
                'required',
            ],
            'gender' => [
                'string',
                'required',
            ],
            'dob' => [
                'string',
                'required',
            ],
            'address_2' => [
                'string',
                'nullable',
            ],
            'city_id' => [
                'nullable',
                'integer',
            ],
            'state_id' => [
                'required',
                'integer',
            ],
            'country_id' => [
                'required',
                'integer',
            ],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name'     => $data['name'],
            'lastname'     => $data['lastname'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'phone'=> $data['phone'],
            'gender'=> $data['gender'],
            'dob'=> $data['dob'],
            'address'=> $data['address'],
            'address_2'=> $data['address_2'],
            'city_id'=> $data['city_id'],
            'state_id'=> $data['state_id'],
            'country_id'=> $data['country_id'],
        ]);
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Mail\WelcomeMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
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
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('auth.register')->with('provincias',DB::table('provincias')->get());
    }

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

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
            'nombre' => 'required|string|min:3|max:25',
            'apellidos' => 'required|string|min:3|max:50',
            'login' => 'required|unique:users|string|min:3|max:20',
            'email' => 'required|string|email|max:50|min:6|unique:users',
            'password' => 'required|string|min:8|max:15|regex:/(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}/|confirmed',
            'provincia' => 'required|integer|exists:provincias,id',
            'telefono' => 'required|integer|regex:/[0-9]{9}/',
            'g-recaptcha-response' => 'required|recaptcha',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {

        $nombre = addslashes($data['nombre']);
        $apellidos = addslashes($data['apellidos']);
        $login = addslashes($data['login']);
        $login = str_replace(" ","",$login);
        $email = addslashes($data['email']);
        $telefono = addslashes($data['telefono']);

        $user = User::create([
            'nombre' => $nombre,
            'apellidos' => $apellidos,
            'login' => $login,
            'email' => $email,
            'password' => bcrypt($data['password']),
            'provincia_id' => $data['provincia'],
            'telefono' => $telefono,
        ]);

        Mail::to($user->email)->send(new WelcomeMail($user->nombre));
        return $user;


    }
}

<?php

namespace App\Http\Controllers;

use App\Mascotas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Auth;
use App\User;
class EditarPerfil extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('editarperfil');
    }

    public function cuenta()
    {
        return view('editarperfil.cuenta');
    }

    public function premium()
    {
        return view('editarperfil.premium');
    }
    public function password()
    {
        return view('editarperfil.password');
    }

    public function mascotas()
    {
        return view('editarperfil.mascotas')->with('num', Auth::user()->mascotas);
    }

    public function editarMascota($id)
    {
        return view('editarperfil.editarmascota')->with('mascota',Mascotas::find($id));
    }

    public function updateCuenta()
    {

        $validation = Validator::make(Input::all(), [
            'nombre' => 'required|string|max:25',
            'apellidos' => 'required|string|max:25',
            'email' => 'required|string|max:50',
            'telefono' => 'required|integer|min:9',
        ]);

        if($validation->fails()) {
            //withInput keep the users info
            return Redirect::back()->withInput()->withErrors($validation->messages());
        } else {

            $user = Auth::user()->id;

            $nombre = Input::get('nombre');
            $email = Input::get('email');
            $apellidos = Input::get('apellidos');
            $telefono = Input::get('telefono');


            User::where('id', $user)->update(array(
                'nombre' => $nombre,
                'apellidos' => $apellidos,
                'email' => $email,
                'telefono' => $telefono,
            ));


            return view('home')->with('mensaje', 'Perfil actualizado correctamente');
        }
    }

    public function updatePremium()
    {

        $validation = Validator::make(Input::all(), [
            'premium' => '',
        ]);

        if($validation->fails()) {
            //withInput keep the users info
            return Redirect::back()->withInput()->withErrors($validation->messages());
        } else {

            $user = Auth::user()->id;

            $p = Input::get('premium');
            if ($p == 'on'){
                $p = 2;
                $mensaje = 'Te has convertido en premium';
            }

            if ($p == ''){
                $p = 1;
                $mensaje = 'Ya no eres premium';
            }


            User::where('id', $user)->update(array(
                'tipo' => $p,
            ));


            return view('home')->with('mensaje', $mensaje);
        }
    }

    public function updatePassword()
    {

        $validation = Validator::make(Input::all(), [
            'password' => 'required|min:6|confirmed',
        ]);

        if($validation->fails()) {
            //withInput keep the users info
            return Redirect::back()->withInput()->withErrors($validation->messages());
        } else {

            $user = Auth::user()->id;
            $pass = Input::get('password');

            User::where('id', $user)->update(array(
                'password' => bcrypt($pass),
            ));


            return view('home')->with('mensaje', 'Contraseña modificada correctamente');
        }
    }

    public function updateMascota($id)
    {

        $validation = Validator::make(Input::all(), [
            'nombre' => 'required|string|max:25',
            'tamanyo' => 'required|string|max:25',
            'edad' => 'required|integer',
        ]);

        if($validation->fails()) {
            //withInput keep the users info
            return Redirect::back()->withInput()->withErrors($validation->messages());
        } else {


            $nombre = Input::get('nombre');
            $tamanyo = Input::get('tamanyo');
            $edad = Input::get('edad');
            $mascota = $id;

            Mascotas::where('id', $mascota)->update(array(
                'nombre' => $nombre,
                'tamanyo' => $tamanyo,
                'edad' => $edad,
            ));


            return view('home')->with('mensaje', 'La mascota ha sido editada correctamente');
        }
    }
}

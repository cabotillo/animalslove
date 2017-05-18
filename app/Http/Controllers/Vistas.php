<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class Vistas extends Controller
{
    //

    public function miperfil($login)
    {
        $user = DB::table('users')->where('login', $login)->get();
        $id = $user[0]->id;

        $tusmascotas = DB::table('mascotas')->select('mascotas.*', 'animal.animal', 'razas.raza')->join('animal', 'animal.id', '=', 'mascotas.animal_id')->join('razas', 'razas.id', '=', 'mascotas.raza_id')->where('user_id', $id)->get();
        $tuspublicaciones = DB::table('publicaciones')->select('publicaciones.*', 'tipopublicacion.tipo')->join('tipopublicacion', 'tipopublicacion.id', '=', 'publicaciones.tipo_id')->where('user_id', $id)->get();

        $data = array(
            'tusmascotas' => $tusmascotas,
            'tuspublicaciones' => $tuspublicaciones,
            'usuario' => $user

        );

        return view('miperfil')->with($data);
    }

    public function selectRaza(Request $request)
    {
        $animal_id = $request->animal_id;

        $razas = DB::table('razas')->where('id_animal', $animal_id)->pluck('raza', 'id')->toArray();

        return response()->json($razas);
    }

    public function busqueda()
    {

        $validation = Validator::make(Input::all(), [
            'animal' => 'required|integer',
            'raza' => 'required|integer',
            'genero' => 'required|string|max:10',
        ]);

        if ($validation->fails()) {
            //withInput keep the users info
            return Redirect::back()->withInput()->withErrors($validation->messages());
        } else {

            $animal = Input::get('animal');
            $raza = Input::get('raza');
            $genero = Input::get('genero');
            $mensaje = '';

            $resultados = DB::table('mascotas')->where([
                ['animal_id', '=', $animal],
                ['raza_id', '=', $raza],
                ['genero', '=', $genero],
            ])->select('mascotas.*', 'razas.raza', 'animal.animal')->join('animal', 'animal.id', '=', 'mascotas.animal_id')->join('razas', 'razas.id', '=', 'mascotas.raza_id')->get();

            if(empty($resultados[0])){
                $mensaje = 'No hay resultados';
            }else{
                $mensaje = 'Mascotas encontradas: '.count($resultados);
            }
            $data = array(
                'resultados' => $resultados,
                'mensaje'  =>$mensaje,
                'tipo' => 'Mascotas Filtradas:',
                'animales' => DB::table('animal')->get()

            );

            return view('busqueda')->with($data);

        }
    }

    public function mascota($id)
    {

        $mascota = DB::table('mascotas')->where('mascotas.id', $id)->select('mascotas.*', 'animal.animal', 'razas.raza')->join('animal', 'animal.id', '=', 'mascotas.animal_id')->join('razas', 'razas.id', '=', 'mascotas.raza_id')->first();

        $imagenes = DB::table('imagenes')->where('mascota_id', $id)->get();

        $id_usuario = $mascota->user_id;
        $usuario = DB::table('users')->where('id', $id_usuario)->first();

        $suspublicaciones = DB::table('publicaciones')->join('tipopublicacion', 'tipopublicacion.id', '=', 'publicaciones.tipo_id')->where('mascota_id', $id)->get();

        $data = array(
            'mascota' => $mascota,
            'imagenes' => $imagenes,
            'usuario' => $usuario,
            'publicaciones' => $suspublicaciones

        );

        return view('mascota')->with($data);
    }

    public function publicacion($id)
    {

        $publicacion = DB::table('publicaciones')->join('tipopublicacion', 'tipopublicacion.id', '=', 'publicaciones.tipo_id')->where('publicaciones.id', $id)->first();

        $id_usuario = $publicacion->user_id;

        $mascota = DB::table('mascotas')->where('mascotas.user_id', $id_usuario)->join('animal', 'animal.id', '=', 'mascotas.animal_id')->join('razas', 'razas.id', '=', 'mascotas.raza_id')->first();

        $usuario = DB::table('users')->where('id', $id_usuario)->first();



        $data = array(
            'mascota' => $mascota,
            'usuario' => $usuario,
            'publicacion' => $publicacion

        );

        return view('publicacion')->with($data);
    }
}






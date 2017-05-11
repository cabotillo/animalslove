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

        $tusmascotas = DB::table('mascotas')->join('animal', 'animal.id', '=', 'mascotas.animal_id')->join('razas', 'razas.id', '=', 'mascotas.raza_id')->where('user_id', $id)->get();
        $tuspublicaciones = DB::table('publicaciones')->join('tipopublicacion', 'tipopublicacion.id', '=', 'publicaciones.tipo_id')->where('user_id', $id)->get();

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
            ])->join('animal', 'animal.id', '=', 'mascotas.animal_id')->join('razas', 'razas.id', '=', 'mascotas.raza_id')->get();

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
}






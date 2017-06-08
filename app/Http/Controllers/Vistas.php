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
        $provincia = DB::table('provincias')->where('provincias.id',$user[0]->provincia_id)->value('provincia');
        $tusmascotas = DB::table('mascotas')->select('mascotas.*')->where([['mascotas.disponible', '=' ,1],['user_id', '=',$id]])->get();
        $tuspublicaciones = DB::table('publicaciones')->select('publicaciones.*', 'tipopublicacion.tipo')->join('tipopublicacion', 'tipopublicacion.id', '=', 'publicaciones.tipo_id')->where([['user_id', $id],['publicaciones.disponible',1]])->get();

        $data = array(
            'tusmascotas' => $tusmascotas,
            'tuspublicaciones' => $tuspublicaciones,
            'usuario' => $user,
            'pro' => $provincia

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
            'animal' => 'required|integer|exists:animal,id',
            'raza' => 'required|integer|exists:razas,id',
            'genero' => 'required|string|max:25@|in:Hembra,Macho',
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
                ['raza_id', '=', $raza],
                ['genero', '=', $genero],
            ])->select('mascotas.*', 'razas.raza', 'animal.animal')->join('razas', 'razas.id', '=', 'mascotas.raza_id')->join('animal','animal.id', '=', 'razas.id_animal')->where('disponible',1)->get();

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

        $mascota = DB::table('mascotas')->where('mascotas.id', $id)->select('mascotas.*', 'razas.id_animal','razas.raza','animal.animal')->join('razas', 'razas.id', '=', 'mascotas.raza_id')->join('animal','animal.id', '=', 'razas.id_animal')->first();

        if($mascota->disponible == 0){
            return redirect()->action('HomeController@index');
        }else{
        $imagenes = DB::table('imagenes')->where('mascota_id', $id)->get();

        $id_usuario = $mascota->user_id;
        $usuario = DB::table('users')->where('id', $id_usuario)->first();

        $suspublicaciones = DB::table('publicaciones')->join('tipopublicacion', 'tipopublicacion.id', '=', 'publicaciones.tipo_id')->where('mascota_id', $id)->get();

        switch ($mascota->animal){
            case 'Perro':
                $icono = '&#128021;';
                break;
            case 'Gato':
                $icono = '&#128008;';
                break;
            case 'Conejo':
                $icono = '&#128007;';
            default:
                $icono = '&#128062;';
        }
        switch ($mascota->genero){
            case 'Macho':
                $genero = "&#9794;";
                break;
                case 'Hembra':
                $genero = '&#9792;';
                break;


        }

        $data = array(
            'mascota' => $mascota,
            'imagenes' => $imagenes,
            'usuario' => $usuario,
            'publicaciones' => $suspublicaciones,
            'icono' => $icono,
            'genero' => $genero

        );

        return view('mascota')->with($data);
        }
    }

    public function publicacion($id)
    {

        $publicacion = DB::table('publicaciones')->join('tipopublicacion', 'tipopublicacion.id', '=', 'publicaciones.tipo_id')->where('publicaciones.id', $id)->first();

        if($publicacion->disponible == 0){

            return redirect()->action('HomeController@index');

        }else {

            $id_usuario = $publicacion->user_id;

            $mascota = DB::table('mascotas')->where('mascotas.user_id', $id_usuario)->select('mascotas.*', 'razas.*', 'animal.animal')->join('razas', 'razas.id', '=', 'mascotas.raza_id')->join('animal', 'animal.id', '=', 'razas.id_animal')->first();

            $usuario = DB::table('users')->where('id', $id_usuario)->first();

            $data = array(
                'mascota' => $mascota,
                'usuario' => $usuario,
                'publicacion' => $publicacion

            );

            return view('publicacion')->with($data);
        }
    }

    public function getFiltro(){

        return view('filtro')->with('provincias',DB::table('provincias')->get());

    }

    public function filtroUsuarios(){


        $this ->b = Input::get('usuario');
        $this->p = Input::get('provincia');
        $usuarios = DB::table('users')->where(function($query){
            $query->where('users.provincia_id', '=',$this->p)->where('nombre', 'like', '%'.$this->b.'%')->get();

        })->orWhere(function ($query){
            $query->where('users.provincia_id', '=',$this->p)->where('apellidos', 'like', '%'.$this->b.'%')->get();
        })->orWhere(function ($query){
            $query->where('users.provincia_id', '=',$this->p)->where('login', 'like', '%'.$this->b.'%')->get();
        })->get();

        $data = array(
            'provincias' => DB::table('provincias')->get(),
            'usuarios' => $usuarios
        );
        return view('filtro')->with($data);

    }


}






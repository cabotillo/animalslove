<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Vistas extends Controller
{
    //

    public function miperfil($login){
        $user = DB::table('users')->where('login',$login)->get();
        $id = $user[0]->id;

        $tusmascotas = DB::table('mascotas')->join('animal', 'animal.id', '=', 'mascotas.animal_id')->join('razas', 'razas.id', '=', 'mascotas.raza_id')->where('user_id',$id)->get();
        $tuspublicaciones = DB::table('publicaciones')->join('tipopublicacion', 'tipopublicacion.id', '=', 'publicaciones.tipo_id')->where('user_id',$id)->get();

        $data = array(
            'tusmascotas' => $tusmascotas,
            'tuspublicaciones' => $tuspublicaciones,
            'usuario' => $user

        );

        return view('miperfil')->with($data);
    }
}

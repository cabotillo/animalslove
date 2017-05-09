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

        $data = array(
            'tusmascotas' => DB::table('mascotas')->where('user_id',$id)->get(),
            'tuspublicaciones' => DB::table('publicaciones')->where('user_id',$id)->get(),
            'usuario' => $user

        );

        return view('miperfil')->with($data);
    }
}

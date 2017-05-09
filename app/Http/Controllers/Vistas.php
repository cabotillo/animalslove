<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Vistas extends Controller
{
    //

    public function miperfil($login){
        $id = DB::table('users')->where('login',$login)->pluck('id');

        $data = array(
            'tusmascotas' => DB::table('mascotas')->where('user_id',$id)->get(),
            'tuspublicaciones' => DB::table('publicaciones')->where('user_id',$id)->get(),

        );

        return view('miperfil')->with($data);
    }
}

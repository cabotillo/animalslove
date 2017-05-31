<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mascotas = DB::table('mascotas')->select('mascotas.*','razas.raza','animal.animal')->join('animal', 'animal.id', '=', 'mascotas.animal_id')->join('razas', 'razas.id', '=', 'mascotas.raza_id')->paginate(15);
        $publicaciones = DB::table('publicaciones')->select('publicaciones.*', 'tipopublicacion.tipo')->join('tipopublicacion', 'tipopublicacion.id', '=', 'publicaciones.tipo_id')->get();
        if(!Auth::guest()){
            $mensajes = count(DB::table('mensajes')->where([
                ['sender_username', '=', Auth::user()->login],
                ['leido', '=', 0],
            ])->get());
        }else{
            $mensajes = '';
        }

        $data = array(

            //'mascotas' => DB::table('mascotas')->take(25)->get(),
            'animales' => DB::table('animal')->get(),
            'razas' => DB::table('razas')->get(),
            'mascotas' => $mascotas,
            'publicaciones' => $publicaciones,
            'mensajes' => $mensajes,

        );
        return view('home')->with($data);
    }

    public function countM()
    {
        return count(DB::table('mensajes')->where([
            ['sender_username', '=', Auth::user()->login],
            ['leido', '=', 0]
        ])->get());
    }

    public  function welcome(){
        return view('welcome');
    }
}

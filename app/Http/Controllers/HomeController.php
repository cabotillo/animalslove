<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $mascotas = DB::table('mascotas')->join('animal', 'animal.id', '=', 'mascotas.animal_id')->join('razas', 'razas.id', '=', 'mascotas.raza_id')->get();
        $publicaciones = DB::table('publicaciones')->join('tipopublicacion', 'tipopublicacion.id', '=', 'publicaciones.tipo_id')->get();


        $data = array(

            //'mascotas' => DB::table('mascotas')->take(25)->get(),
            'animales' => DB::table('animal')->get(),
            'razas' => DB::table('razas')->get(),
            'mascotas' => $mascotas,
            'publicaciones' => $publicaciones

        );
        return view('home')->with($data);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

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
        $mascotas = DB::table('mascotas')->select('mascotas.*','razas.raza')->join('razas', 'razas.id', '=', 'mascotas.raza_id')->orderBy('mascotas.id','DESC')->where('mascotas.disponible',1)->paginate(15);
        $publicaciones = DB::table('publicaciones')->select('publicaciones.*', 'tipopublicacion.tipo')->join('tipopublicacion', 'tipopublicacion.id', '=', 'publicaciones.tipo_id')->where('publicaciones.disponible',1)->get();
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

    public function filtro(){

        $b = Input::get('b');

        $validation = Validator::make(Input::all(), [
            'b' => 'required|min:3',
        ]);

        if ($validation->fails()) {
            return view('filtro')->with('provincias',DB::table('provincias')->get());
        } else {

            $mascotas = DB::table('mascotas')->where([
                ['nombre', 'like', '%'.$b.'%'],
            ])->get();

            $usuarios = DB::table('users')->where('nombre', 'like', '%'.$b.'%')->orWhere('apellidos', 'like', '%'.$b.'%')->orWhere('login', 'like', '%'.$b.'%')->get();

            $data = array(
                'provincias' => DB::table('provincias')->get(),
                'mascotas' => $mascotas,
                'usuarios' => $usuarios,
                'b' => $b
            );

            return view('filtro')->with($data);

        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;


class AdminController extends Controller
{
    //


    public function __construct()
    {
        $this->middleware('admin')->except('logout');
    }

    public function index(){

        $usuarios = User::all();
        $data =array(
            'usuarios' => $usuarios,

        );

        return view('admin')->with($data);
    }

    /*public function  postAdmin($id){
        if(Input::get('reporte')){
            $this->reporte($id);
            echo "<script>alert('REPORTE')</script>";
        }elseif (Input::get('admin')){
            echo "<script>alert('NOO')</script>";
        }else{

        }
    }*/

    public function reporte($id){

        $mascotas = DB::table('mascotas')->select('mascotas.id','mascotas.nombre')->join('animal', 'animal.id', '=', 'mascotas.animal_id')->join('razas', 'razas.id', '=', 'mascotas.raza_id')->where('user_id', $id)->get();
        $publicaciones = DB::table('publicaciones')->select('publicaciones.id','publicaciones.titulo')->join('tipopublicacion', 'tipopublicacion.id', '=', 'publicaciones.tipo_id')->where('user_id', $id)->get();
        $reportes = DB::table('reportes')->where('user_id', $id)->count();
        $usuario = DB::table('users')->where('id', $id)->value('login');

        $data = array(
            'mascotas' => $mascotas,
            'publicacion' => $publicaciones,
            'r' => $reportes,
            'u' => $usuario
        );

        return view('reporte')->with($data);


    }

    public function postReporte()
    {
        $mascota_id = Input::get('mascota');
        $publicacion_id = Input::get('publicacion');
        $user_id = Input::get('user_id');

        $user_id = DB::table('users')->where('login', $user_id)->value('id');

        $reporte = array(
            'user_id' => $user_id,
            'publicacion_id' => $publicacion_id,
            'mascota_id' => $mascota_id
        );


        DB::table('reportes')->insert($reporte);
        $data = array(
            'mensaje' => 'El reporte se ha introducido'

        );

        return view('welcome')->with($data);

    }

}

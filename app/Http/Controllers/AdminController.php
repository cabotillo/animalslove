<?php

namespace App\Http\Controllers;

use App\Reporte;
use Illuminate\Support\Facades\Validator;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use function MongoDB\BSON\toJSON;


class AdminController extends Controller
{
    //


    public function __construct()
    {
        $this->middleware('admin')->except('logout');
    }

    public function index(){

        $usuarios = User::orderBy('disponible','DESC')->orderBy('tipo','ASC')->get();
        foreach ($usuarios as $u){
            switch ($u->tipo){
                case '1':
                    $u->tipo = 'Usuario';
                    break;
                case '2':
                    $u->tipo = 'Premium';
                    break;
                case '3':
                    $u->tipo = 'Administrador';
                    break;

            }

        }
        $data =array(
            'usuarios' => $usuarios,

        );

        return view('admin')->with($data);
    }

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


        $reportes = DB::table('reportes')->where('user_id',$user_id)->count();

        if($reportes >= 3){
            DB::table('users')->where('id',$user_id)->update(['disponible' => 0]);
            $data = array(
                'mensaje' => 'El reporte se ha introducido y se ha bloqueado al usuario',

            );
        }else{
            $data = array(
                'mensaje' => 'El reporte se ha introducido'

            );
        }


        return view('welcome')->with($data);

    }
    public function admin($id)
    {

        DB::table('users')->where('id',$id)->update(['tipo' =>3]);

        return view('welcome')->with('mensaje', 'Le has dado permisos a el usuario');

    }

    public function getPerfil($id)
    {

        $data = DB::table('users')->where('id',$id)->first();

        $data = collect($data)->map(function($x){ return (array) $x; })->toArray();

        return view('editarperfil')->with($data);

    }

    public function bloquear($id)
    {

        DB::table('users')->where('id',$id)->update(['disponible' =>0]);

        return view('welcome')->with('mensaje', 'Has bloqueado al usuario correctamente');

    }

    public function postPerfil($id)
    {
        $validation = Validator::make(Input::all(), [
            'nombre' => 'required|string|max:25',
            'apellidos' => 'required|string|max:50',
            'email' => 'required|email|max:50',
            'telefono' => 'required|integer|regex:/[0-9]{9}/',
            'avatar' => 'mimes:jpeg,bmp,png'
        ]);

        if($validation->fails()) {
            //withInput keep the users info
            return Redirect::back()->withInput()->withErrors($validation->messages());
        } else {

            //Recogo la imagen si la hay

            if(request()->file('avatar') != ''){

                $login = DB::table('users')->where('id',$id)->value('login');

                $file = request()->file('avatar');
                $ext = $file->guessClientExtension();

                $carpeta = 'usuarios/';
                $nombreFichero = $login.".".$ext;

                $file->storeAs($carpeta.$login,$nombreFichero);

                $nombre = Input::get('nombre');
                $email = Input::get('email');
                $apellidos = Input::get('apellidos');
                $telefono = Input::get('telefono');

                User::where('id', $id)->update(array(
                    'nombre' => $nombre,
                    'apellidos' => $apellidos,
                    'email' => $email,
                    'telefono' => $telefono,
                    'avatar' => $carpeta.$login."/".$nombreFichero
                ));


                return view('welcome')->with('mensaje', 'Perfil actualizado correctamente con avatar');

            }else{

                $nombre = Input::get('nombre');
                $email = Input::get('email');
                $apellidos = Input::get('apellidos');
                $telefono = Input::get('telefono');

                User::where('id', $id)->update(array(
                    'nombre' => $nombre,
                    'apellidos' => $apellidos,
                    'email' => $email,
                    'telefono' => $telefono,
                ));
                return view('welcome')->with('mensaje', 'Perfil actualizado correctamente');

            }
        }

    }

}

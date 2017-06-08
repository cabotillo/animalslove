<?php

namespace App\Http\Controllers;

use App\Mascotas;
use File;
use Illuminate\Support\Facades\Session;
use Image;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Auth;
use App\User;
use Mockery\Exception;
use View;

class EditarPerfil extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('editarperfil');
    }

    public function cuenta()
    {
        return view('editarperfil.cuenta')->with('provincias',DB::table('provincias')->get());
    }

    public function premium()
    {
        return view('editarperfil.premium');
    }
    public function password()
    {
        return view('editarperfil.password');
    }
    public function editarMascota($id)
    {
        $mascota = DB::table('mascotas')->select('mascotas.*','animal.animal', 'razas.id_animal','razas.raza')->join('razas', 'razas.id', '=', 'mascotas.raza_id')->join('animal','animal.id', '=', 'razas.id_animal')->where('mascotas.id',$id)->first();
        if($mascota->user_id == Auth::user()->id)
            return view('editarmascota')->with('mascota',$mascota);
        else {
            return redirect()->route('home');
        }
    }
    public function addMascota()
    {
        $data = array(
            'animales' => DB::table('animal')->get(),
            'razas' => DB::table('razas')->get(),
        );
        return view('editarperfil.addmascota')->with($data);
    }

    public function updateCuenta()
    {

        $validation = Validator::make(Input::all(), [
            'nombre' => 'required|string|min:3|max:25',
            'apellidos' => 'required|string|min:3|max:50',
            'telefono' => 'required|integer|regex:/[0-9]{9}/',
            'provincia' => 'required|integer|exists:provincias,id',
            'avatar' => 'mimes:jpeg,bmp,png'
        ]);

        if($validation->fails()) {
            return Redirect::back()->withInput()->withErrors($validation->messages());
        } else {

            //Recogo la imagen si la hay

            if(request()->file('avatar') != '') {


                $login = Auth::user()->login;

                $file = request()->file('avatar');
                $ext = $file->guessClientExtension();

                $carpeta = 'usuarios/';
                $nombreFichero = $login . "." . $ext;

                $file->storeAs($carpeta . $login, $nombreFichero);

                $user = Auth::user()->id;

                $nombre = Input::get('nombre');
                $apellidos = Input::get('apellidos');
                $telefono = Input::get('telefono');
                $provincia = Input::get('provincia');

                try {
                    User::where('id', $user)->update(array(
                        'nombre' => $nombre,
                        'apellidos' => $apellidos,
                        'telefono' => $telefono,
                        'provincia_id' => $provincia,
                        'avatar' => $carpeta . $login . "/" . $nombreFichero,
                    ));


                    return redirect()->action('EditarPerfil@cuenta', ['u' => 1]);
                } catch (Exception $e){
                    return redirect()->action('EditarPerfil@cuenta', ['u' => 0]);
                }
            }else{

                $user = Auth::user()->id;

                $nombre = Input::get('nombre');
                $apellidos = Input::get('apellidos');
                $telefono = Input::get('telefono');
                $provincia = Input::get('provincia');

                try {
                    User::where('id', $user)->update(array(
                        'nombre' => $nombre,
                        'apellidos' => $apellidos,
                        'telefono' => $telefono,
                        'provincia_id' => $provincia
                    ));
                    return redirect()->action('EditarPerfil@cuenta', ['u' => 1]);
                }catch (Exception $e){
                    return redirect()->action('EditarPerfil@cuenta', ['u' => 0]);
                }

            }
        }
    }

    public function updatePremium()
    {

        $validation = Validator::make(Input::all(), [
            'premium' => '',
        ]);

        if($validation->fails()) {
            //withInput keep the users info
            return Redirect::back()->withInput()->withErrors($validation->messages());
        } else {

            $user = Auth::user()->id;

            $p = Input::get('premium');
            if ($p == 'on'){
                $p = 2;
            }
            if ($p == ''){
                $p = 1;
            }

            try{
                if(Auth::user()->tipo != 3){
                    User::where('id', $user)->update(array(
                        'tipo' => $p,
                    ));
                }
                return redirect()->action('EditarPerfil@premium', ['u' => $p]);
            }catch (Exception $e){
                return redirect()->action('EditarPerfil@premium', ['u' => 0]);
            }

        }
    }

    public function updatePassword()
    {

        $validation = Validator::make(Input::all(), [
            'password' => 'required|string|min:6|max:15|regex:/(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}/|confirmed',
        ]);

        if($validation->fails()) {
            //withInput keep the users info
            return Redirect::back()->withInput()->withErrors($validation->messages());
        } else {

            $user = Auth::user()->id;
            $pass = Input::get('password');

            try{
                User::where('id', $user)->update(array(
                    'password' => bcrypt($pass),
                ));
                return redirect()->action('EditarPerfil@password', ['u' => 1]);
            }catch (Exception $e){
                return redirect()->action('EditarPerfil@password', ['u' => 0]);
            }
        }
    }

    public function updateMascota($id)
    {

        $validation = Validator::make(Input::all(), [
            'tamanyo' => 'required|string|max:25|in:Pequeño,Mediano,Grande,Gigante',
            'edad' => 'required|integer',
            'img' => 'mimes:jpeg,bmp,png|max:5000'

        ]);

        if($validation->fails()) {
            //withInput keep the users info
            return Redirect::back()->withInput()->withErrors($validation->messages());
        } else {

            if(request()->file('img') != '') {

            $mascota = $id;

            $file = request()->file('img');
            $ext = $file->guessClientExtension();

            $carpeta = 'mascotas/';
            $nombreFichero = $mascota.".".$ext;

            $file->storeAs($carpeta.$mascota,$nombreFichero);

            $tamanyo = Input::get('tamanyo');
            $edad = Input::get('edad');

            try {
                Mascotas::where('id', $mascota)->update(array(
                    'tamanyo' => $tamanyo,
                    'edad' => $edad,
                    'avatar' => $carpeta . $mascota . "/" . $nombreFichero
                ));

                return redirect()->action('Vistas@mascota', ['id' => $id, 'u' => 1]);
            }catch (Exception $e){
                return redirect()->action('Vistas@mascota', ['id' => $id, 'u' => 0]);

            }

            }else{

                $tamanyo = Input::get('tamanyo');
                $edad = Input::get('edad');
                $mascota = $id;
                try {
                    Mascotas::where('id', $mascota)->update(array(
                        'tamanyo' => $tamanyo,
                        'edad' => $edad,
                    ));

                    return redirect()->action('Vistas@mascota', ['id' => $id, 'u' => 1]);
                }catch (Exception $e){
                    return redirect()->action('Vistas@mascota', ['id' => $id, 'u' => 0]);
                }
           }
        }
    }

    public function insertarMascota()
    {
        $validation = Validator::make(Input::all(), [
            'nombre' => 'required|string|min:3|max:25',
            'raza' => 'required|integer|exists:razas,id',
            'genero' => 'required|string|max:25@|in:Hembra,Macho',
            'tamanyo' => 'required|string|max:25|in:Pequeño,Mediano,Grande,Gigante',
            'img' => 'mimes:jpeg,bmp,png',
            'edad' => 'required|integer'
        ]);

        if ($validation->fails()) {
            //withInput keep the users info
            return Redirect::back()->withInput()->withErrors($validation->messages());
        } else {

            if (request()->file('img') != '') {

                $nombre = Input::get('nombre');
                $raza = Input::get('raza');
                $genero = Input::get('genero');
                $tamanyo = Input::get('tamanyo');
                $edad = Input::get('edad');
                $user = Auth::user()->id;
                $login = Auth::user()->login;

                $file = request()->file('img');
                $ext = $file->guessClientExtension();

                $carpeta = 'mascotas/';
                $nombreFichero = $nombre.$login.".".$ext;
                $file->storeAs($carpeta.$login, $nombreFichero);
                $avatar = $carpeta.$login."/".$nombreFichero;

                $mascota = array(
                    'user_id' => $user,
                    'nombre' => $nombre,
                    'raza_id' => $raza,
                    'genero' => $genero,
                    'tamanyo' => $tamanyo,
                    'avatar' => $avatar,
                    'edad' => $edad,
                    'updated_at' => time()
                );
                try{
                    $id = DB::table('mascotas')->insertGetId($mascota);
                    return redirect()->action('Vistas@mascota', ['id' => $id, 'u' => 1]);
                }catch (Exception $e){
                    return redirect()->action('Vistas@mascota', ['id' => $id, 'u' => 0]);
                }

            }else {

                $nombre = Input::get('nombre');
                $raza = Input::get('raza');
                $genero = Input::get('genero');
                $tamanyo = Input::get('tamanyo');
                $edad = Input::get('edad');
                $user = Auth::user()->id;
                $avatar = 'mascotas/avatar.jpg';


                $mascota = array(
                    'user_id' => $user,
                    'nombre' => $nombre,
                    'raza_id' => $raza,
                    'genero' => $genero,
                    'tamanyo' => $tamanyo,
                    'avatar' => $avatar,
                    'edad' => $edad,
                    'updated_at' => time()
                );
                try{
                    $id = DB::table('mascotas')->insertGetId($mascota);
                    return redirect()->action('Vistas@mascota', ['id' => $id, 'u' => 1]);
                }catch (Exception $e){
                    return redirect()->action('Vistas@mascota', ['id' => $id, 'u' => 0]);
                }
            }
    }
}

    public function addPublicacion(){

        $data = array(
                'mascotas' => DB::table('mascotas')->where('user_id',Auth::user()->id )->get(),
                'tipop' => DB::table('tipopublicacion')->get(),
            );
        return view('addpublicacion')->with($data);
    }

    public function insertarPublicacion()
    {

        $validation = Validator::make(Input::all(), [
            'mascota' => 'required|integer|exists:mascotas,id',
            'publicacion' => 'required|integer|exists:tipopublicacion,id',
            'cuerpo' => 'required|string|max:250',
        ]);

        if ($validation->fails()) {
            //withInput keep the users info
            return Redirect::back()->withInput()->withErrors($validation->messages());
        } else {

            $mascota = Input::get('mascota');
            $tipo = Input::get('publicacion');
            $cuerpo = Input::get('cuerpo');
            $id = Auth::user()->id;

            $tipovarchar = DB::table('tipopublicacion')->where('id' , $tipo)->value('tipo');

            $nombreM = DB::table('mascotas')->where('id',$mascota)->value('nombre');
            $titulo = "Quiero ".$tipovarchar." a ".$nombreM;
            $publicacion = array(
                'titulo' => $titulo,
                'cuerpo' => $cuerpo,
                'user_id' => $id,
                'mascota_id' => $mascota,
                'tipo_id' => $tipo,
                'disponible' => 1
            );

            try{

                DB::table('publicaciones')->insert($publicacion);
                return redirect()->action('EditarPerfil@insertarPublicacion', ['u' => 1]);
            }catch (Exception $e){
                return redirect()->action('EditarPerfil@insertarPublicacion', ['u' => 0]);
            }


        }
    }
    public function addImagenes($id){


        $mascota = DB::table('mascotas')->where('id', $id)->get()->first();

        if($mascota->user_id != Auth::user()->id){
            return redirect()->action('HomeController@index');
        }else{


        $imagenes = DB::table('imagenes')->where('mascota_id',$id)->get();

        $data = array(
            'mascota' => $mascota,
            'imagenes' => $imagenes
        );

        return view('imagenes')->with($data);
        }
    }

    public function postInsertImagenes($id)
    {
        $files = request()->file('file');

        foreach ($files as $file) {
            $count = DB::table('imagenes')->where('mascota_id',$id)->count();
            $ext = $file->guessClientExtension();
            $carpeta = 'mascotas/';

            $nombreFichero = $id."_".$count.".".$ext;

            $file->storeAs($carpeta . $id, $nombreFichero);

             //$img = Image::make($file)->resize(100,100)->steam();

             //$img->storeAS($carpeta."a.jpg");

            $imagen = array(
                'mascota_id' => $id,
                'imagen' => $id."/".$nombreFichero
            );
            DB::table('imagenes')->insert($imagen);


        }

    }

    public function postDeleteImagenes(){

        $img = Input::get('id');
        $idImg = DB::table('imagenes')->select('mascota_id')->where('imagen', $img)->delete();
        $mascota = explode("/", $img);
        $nombreImagen = $mascota[1];
        $mascota = $mascota[0];


        try{
            File::Delete(public_path().'\storage\mascotas\\'.$mascota.'\\'.$nombreImagen);
            DB::table('imagenes')->where('imagen', $idImg)->delete();

           return redirect()->action('EditarPerfil@addImagenes',['id' => $mascota,'u' => 1]);
        }catch (Exception $e){
            return redirect()->action('EditarPerfil@addImagenes',['id' => $mascota,'u' => 0]);
        }

    }

    public  function administrar(){
        $mismascotas = DB::table('mascotas')->where('user_id', Auth::user()->id)->orderBy('disponible','DESC')->get();

        $mispublicaciones = DB::table('publicaciones')->where('user_id', Auth::user()->id)->orderBy('disponible','DESC')->get();

        $data = array(
            'mascotas' => $mismascotas,
            'publicaciones' => $mispublicaciones,
        );

        return view('editarperfil.panel')->with($data);
    }
    public function eliminarMascota($id){

        $num = DB::table('mascotas')->where('id',$id)->value('disponible');

        $d = $num==1?'0':'1';
        $mensaje = $num==1?'Tu mascota ha sido ocultada con éxito':'Tu mascota ahora esta disponible';

        try{
            DB::table('mascotas')->where('id',$id)->update(['disponible' => $d]);
            DB::table('publicaciones')->where('mascota_id',$id)->update(['disponible' => $d]);
            Session::flash('message', $mensaje);
            return redirect()->action('EditarPerfil@administrar');

        }catch (Exception $e){
            Session::flash('error', 'Se ha producido un error. Vuelve a intentarlo más tarde');
            return redirect()->action('EditarPerfil@administrar');
        }

    }
    public function eliminarPublicacion($id){

        $num = DB::table('publicaciones')->where('id',$id)->value('disponible');

        $d = $num==1?'0':'1';
        $mensaje = $num==1?'Tu publicación ha sido eliminada con éxito':'Tu publicación ahora esta disponible';

        try{
            DB::table('publicaciones')->where('id',$id)->update(['disponible' => $d]);
            Session::flash('message', $mensaje);
            return redirect()->action('EditarPerfil@administrar');

        }catch (Exception $e){
            Session::flash('error', 'Se ha producido un error. Vuelve a intentarlo más tarde');
            return redirect()->action('EditarPerfil@administrar');
        }

    }

}
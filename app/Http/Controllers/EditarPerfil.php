<?php

namespace App\Http\Controllers;

use App\Mascotas;
use Image;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Auth;
use App\User;
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
        $mascota = DB::table('mascotas')->select('mascotas.*','animal.animal', 'razas.raza')->join('animal', 'animal.id', '=', 'mascotas.animal_id')->join('razas', 'razas.id', '=', 'mascotas.raza_id')->where('mascotas.id',$id)->get()->first();

        if($mascota->user_id == Auth::user()->id)
            return view('editarperfil.editarmascota')->with('mascota',$mascota);
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
            'email' => 'required|string|email|max:50|min:6|unique:users',
            'telefono' => 'required|integer|regex:/[0-9]{9}/',
            'provincia' => 'required|integer|exists:provincias,id',
            'avatar' => 'mimes:jpeg,bmp,png'
        ]);

        if($validation->fails()) {
            //withInput keep the users info
            return Redirect::back()->withInput()->withErrors($validation->messages());
        } else {

            //Recogo la imagen si la hay

            if(request()->file('avatar') != ''){


            $login = Auth::user()->login;

            $file = request()->file('avatar');
            $ext = $file->guessClientExtension();

            $carpeta = 'usuarios/';
            $nombreFichero = $login.".".$ext;

            $file->storeAs($carpeta.$login,$nombreFichero);

            //$path = public_path('usuarios\\'.$login);

            //Image::make($file->getRealPath())->resize(100, 100)->save($path.".".$ext);



            $user = Auth::user()->id;

            $nombre = Input::get('nombre');
            $email = Input::get('email');
            $apellidos = Input::get('apellidos');
            $telefono = Input::get('telefono');
            $provincia = Input::get('provincia');

            User::where('id', $user)->update(array(
                'nombre' => $nombre,
                'apellidos' => $apellidos,
                'email' => $email,
                'telefono' => $telefono,
                'provincia_id' => $provincia,
                'avatar' => $carpeta.$login."/".$nombreFichero,
            ));


                return redirect()->action('EditarPerfil@cuenta', ['u' => 1]);

            }else{

                $user = Auth::user()->id;

                $nombre = Input::get('nombre');
                $email = Input::get('email');
                $apellidos = Input::get('apellidos');
                $telefono = Input::get('telefono');
                $provincia = Input::get('provincia');

                User::where('id', $user)->update(array(
                    'nombre' => $nombre,
                    'apellidos' => $apellidos,
                    'email' => $email,
                    'telefono' => $telefono,
                    'provincia_id' => $provincia
                ));
                return redirect()->action('EditarPerfil@cuenta', ['u' => 1]);

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

            if(Auth::user()->tipo != 3){
                User::where('id', $user)->update(array(
                    'tipo' => $p,
                ));
            }
            return redirect()->action('EditarPerfil@premium', ['u' => $p]);

        }
    }

    public function updatePassword()
    {

        $validation = Validator::make(Input::all(), [
            'password' => 'required|min:6|confirmed',
        ]);

        if($validation->fails()) {
            //withInput keep the users info
            return Redirect::back()->withInput()->withErrors($validation->messages());
        } else {

            $user = Auth::user()->id;
            $pass = Input::get('password');

            User::where('id', $user)->update(array(
                'password' => bcrypt($pass),
            ));


            return redirect()->action('EditarPerfil@password', ['u' => 1]);
        }
    }

    public function updateMascota($id)
    {

        $validation = Validator::make(Input::all(), [
            'tamanyo' => 'required|string|max:25',
            'edad' => 'required|integer',
            'img' => 'mimes:jpeg,bmp,png'

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

            Mascotas::where('id', $mascota)->update(array(
                'tamanyo' => $tamanyo,
                'edad' => $edad,
                'avatar' => $carpeta.$mascota."/".$nombreFichero
            ));

                return redirect()->action('EditarPerfil@editarMascota', ['u' => 1]);

            }else{

                $tamanyo = Input::get('tamanyo');
                $edad = Input::get('edad');
                $mascota = $id;

                Mascotas::where('id', $mascota)->update(array(
                    'tamanyo' => $tamanyo,
                    'edad' => $edad,
                ));


                return redirect()->action('Vistas@mascota',['id' => $id,'u' => 1]);
           }
        }
    }

    public function insertarMascota()
    {
        $validation = Validator::make(Input::all(), [
            'nombre' => 'required|string|min:3|max:25',
            'animal' => 'required|integer|exists:animal,id',
            'raza' => 'required|integer|exists:razas,id',
            'genero' => 'required|string|max:25@|in:Hembra,Macho',
            'tamanyo' => 'required|string|max:25|in:Pequeño,Mediano,Grande,Gigante',
            'img' => 'mimes:jpeg,bmp,png',
            'edad' => 'required|integer|max:3'
        ]);

        if ($validation->fails()) {
            //withInput keep the users info
            return Redirect::back()->withInput()->withErrors($validation->messages());
        } else {

            if (request()->file('img') != '') {

                $nombre = Input::get('nombre');
                $animal = Input::get('animal');
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
                    'animal_id' => $animal,
                    'raza_id' => $raza,
                    'genero' => $genero,
                    'tamanyo' => $tamanyo,
                    'avatar' => $avatar,
                    'edad' => $edad,
                    'updated_at' => time()
                );
                DB::table('mascotas')->insert($mascota);

                return redirect()->action('EditarPerfil@addMascotas', ['u' => 1]);

            }else {

                $nombre = Input::get('nombre');
                $animal = Input::get('animal');
                $raza = Input::get('raza');
                $genero = Input::get('genero');
                $tamanyo = Input::get('tamanyo');
                $edad = Input::get('edad');
                $user = Auth::user()->id;
                $avatar = 'mascotas/avatar.jpg';


                $mascota = array(
                    'user_id' => $user,
                    'nombre' => $nombre,
                    'animal_id' => $animal,
                    'raza_id' => $raza,
                    'genero' => $genero,
                    'tamanyo' => $tamanyo,
                    'avatar' => $avatar,
                    'edad' => $edad,
                    'updated_at' => time()
                );
                DB::table('mascotas')->insert($mascota);

                return redirect()->action('EditarPerfil@addMascotas', ['u' => 1]);
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

            DB::table('publicaciones')->insert($publicacion);

            return redirect()->action('EditarPerfil@insertarPublicacion', ['u' => 1]);


        }
    }
    public function addImagenes($id){
        $mascota = DB::table('mascotas')->where('id', $id)->get()->first();
        $imagenes = DB::table('imagenes')->where('mascota_id',$id)->get();

        $data = array(
            'mascota' => $mascota,
            'imagenes' => $imagenes
        );

        return view('imagenes')->with($data);
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

            $imagen = array(
                'mascota_id' => $id,
                'imagen' => $id."/".$nombreFichero
            );

                DB::table('imagenes')->insert($imagen);
        }


        return redirect()->action('EditarPerfil@addImagenes',['id' => $id,'u' => 2]);

    }

    public function postDeleteImagenes(){

        $id = Input::get('id');
        $p = DB::table('imagenes')->select('mascota_id')->where('imagen', $id)->delete();
        DB::table('imagenes')->where('imagen', $id)->delete();


        return redirect()->action('EditarPerfil@addImagenes',['id' => $p,'u' => 1]);
    }

}
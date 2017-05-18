<?php

namespace App\Http\Controllers;

use App\Mascotas;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Auth;
use App\User;
use Illuminate\Validation\Rules\In;
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

    public function mascotas()
    {
        $data = array(

            'num' => Auth::user()->mascotas,
            'animales' => DB::table('animal')->get()

        );
        return view('editarperfil.mascotas')->with($data);
    }

    public function editarMascota($id)
    {
        $mascota = DB::table('mascotas')->select('mascotas.*','animal.animal', 'razas.raza')->join('animal', 'animal.id', '=', 'mascotas.animal_id')->join('razas', 'razas.id', '=', 'mascotas.raza_id')->where('mascotas.id',$id)->get()->first();

        return view('editarperfil.editarmascota')->with('mascota',$mascota);
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
            'nombre' => 'required|string|max:25',
            'apellidos' => 'required|string|max:25',
            'email' => 'required|string|max:50',
            'telefono' => 'required|integer|min:9',
            'provincia' => 'required|integer',
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
                'avatar' => $carpeta.$login."/".$nombreFichero
            ));


            return view('welcome')->with('mensaje', 'Perfil actualizado correctamente con avatar');

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
                return view('welcome')->with('mensaje', 'Perfil actualizado correctamente');

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
                $mensaje = 'Te has convertido en premium';
            }

            if ($p == ''){
                $p = 1;
                $mensaje = 'Ya no eres premium';
            }

            if(Auth::user()->tipo == 3){
                $mensaje = "Un admin no puede ser premium";
            }else{
            User::where('id', $user)->update(array(
                'tipo' => $p,
            ));
            }


            return view('welcome')->with('mensaje', $mensaje);

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


            return view('welcome')->with('mensaje', 'Contraseña modificada correctamente');
        }
    }

    public function updateMascota($id)
    {

        $validation = Validator::make(Input::all(), [
            'tamanyo' => 'required|string|max:25',
            'edad' => 'required|integer',
            'img' => ''

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

            $nombre = Input::get('nombre');
            $tamanyo = Input::get('tamanyo');
            $edad = Input::get('edad');

            Mascotas::where('id', $mascota)->update(array(
                'tamanyo' => $tamanyo,
                'edad' => $edad,
                'avatar' => $carpeta.$mascota."/".$nombreFichero
            ));


            return view('welcome')->with('mensaje', 'La mascota ha sido editada correctamente con su avatar');

            }else{

                $tamanyo = Input::get('tamanyo');
                $edad = Input::get('edad');
                $mascota = $id;

                Mascotas::where('id', $mascota)->update(array(
                    'tamanyo' => $tamanyo,
                    'edad' => $edad,
                ));


                return view('welcome')->with('mensaje', 'La mascota ha sido editada correctamente');
           }
        }
    }

    public function insertarMascota()
    {
        $validation = Validator::make(Input::all(), [
            'nombre' => 'required|string|max:25',
            'animal' => 'required|integer',
            'raza' => 'required|integer',
            'genero' => 'required|string|max:25',
            'tamanyo' => 'required|string|max:25',
            'img' => '',
            'edad' => 'required|integer:max:3'
        ]);

        if ($validation->fails()) {
            //withInput keep the users info
            return Redirect::back()->withInput()->withErrors($validation->messages());
        } else {

            $nombre = Input::get('nombre');
            $animal = Input::get('animal');
            $raza = Input::get('raza');
            $genero = Input::get('genero');
            $tamanyo = Input::get('tamanyo');
            $edad = Input::get('edad');
            $user = Auth::user()->id;

            if (request()->file('img') != '') {

                $file = request()->file('img');
                $ext = $file->guessClientExtension();

                $carpeta = 'mascotas/';
                $id = DB::table('mascotas')->get('id')->last();
                $nombreFichero = $id.".".$ext;
                $file->storeAs($carpeta.$id, $nombreFichero);
                $avatar = $carpeta.$id."/".$nombreFichero;
            }else {

                $avatar = 'mascotas/avatar.jpg';
            }


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

            return view('welcome')->with('mensaje', 'La mascota ha sido añadida correctamente');
        }
    }

    public function addPublicacion(){

        $data = array(
                'mascotas' => DB::table('mascotas')->get(),
                'tipop' => DB::table('tipopublicacion')->get(),
            );
        return view('addpublicacion')->with($data);
    }

    public function insertarPublicacion()
    {

        $validation = Validator::make(Input::all(), [
            'mascota' => 'required|integer',
            'publicacion' => 'required|integer',
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


            return view('welcome')->with('mensaje', 'La publicación ha sido añadida correctamente');

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

    public function postInsertImagenes()
    {
        /*$files = request()->file('file');
        $mascota = Input::get('id');
        foreach ($files as $file) {
            $id = DB::table('imagenes')->select('id')->where('mascota_id', $mascota);
            $ext = $file->guessClientExtension();
            $carpeta = 'mascotas/';

            $nombreFichero = $mascota . $id . $ext;

            $file->storeAs($carpeta . $mascota, $nombreFichero);
        }*/
        echo "<script>alert('IE')</script>";
        print_r(request()->file('file'));

        return view('welcome')->with('mensaje', 'Imágenes subidas correctamente');
    }

    public function postDeleteImagenes(){
        $file = Input::get('file');



    }

}

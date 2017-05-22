<?php

namespace App\Http\Controllers;

use App\User;
use App\Mensajes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('premium')->except('logout');
    }
    public function index(){

        $tuschats1 = DB::table('chats')->select('login','avatar','chats.updated_at')->where('user_id_2', Auth::user()->login)->join('users','chats.user_id_1', '=', 'users.login')->get();
        $tuschats2 = DB::table('chats')->select('login','avatar','chats.updated_at')->where('user_id_1', Auth::user()->login)->join('users','chats.user_id_2', '=', 'users.login')->get();

        $tuschats = $tuschats1->merge($tuschats2);

        $data = array(
            'chats' => $tuschats

        );

        return view('mismensajes')->with($data);
    }

    public function comprobar($login){

        $loginChatT = Auth::user()->login; //Login del usuario
                
       $existe1 = DB::table('chats')->where([
            ['user_id_1', '=',$login],
            ['user_id_2', '=',$loginChatT],
        ])->first();

        $existe2 = DB::table('chats')->where([
            ['user_id_1', '=',$loginChatT],
            ['user_id_2', '=',$login],
        ])->first();

        if($existe1 || $existe2){
            return redirect('mensajes/');
        }else{
            DB::table('chats')->insert([

                'user_id_1' => $login,
                'user_id_2' => $loginChatT,
                ]);
            return redirect('mensajes/');
        }
    }

    public function cargarMensajes($login){

       $mensajes = DB::table('mensajes')->where([
           ['send_username', '=',$login],
           ['sender_username', '=',  Auth::user()->login],
       ])->orWhere([
           ['send_username', '=', Auth::user()->login],
           ['sender_username', '=',$login],
           ])->select('message','send_username', 'created_at','leido')->orderBy('created_at', 'asc')->get();

        Mensajes::where([
            ['send_username', '=',$login],
            ['sender_username', '=',  Auth::user()->login],
        ])->update(array(
            'leido' => 1
        ));


        $data = array(
            'mensajes' => $mensajes,
            'usuario' => $login,
        );

        return view('mensajes')->with($data);
    }

    public function enviarMensaje()
    {

        $txt = Input::get('mensaje');
        $sender = Input::get('sender');

        $mensaje = array(
            'send_username' => Auth::user()->login,
            'sender_username' => $sender,
            'message' => $txt
        );
        DB::table('mensajes')->insert($mensaje);

        return view('welcome')->with('mensaje', 'Mensaje enviado');
     }
}


<?php

namespace App\Http\Controllers;

use App\User;
use App\Mensajes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Mockery\Exception;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('premium')->except('logout');
    }
    public function index(){

        $tuschats1 = DB::table('chats')->select('users.login','users.avatar','chats.updated_at','mensajes.message','mensajes.leido')->where([
            ['user_login_2', Auth::user()->login],
            ['sender_username', Auth::user()->login]
            ])->join('users','chats.user_login_1', '=', 'users.login')->join('mensajes','send_username', '=', 'users.login')->groupBy('users.login')->orderBy('chats.updated_at','DESC')->get();

        $tuschats2 = DB::table('chats')->select('users.login','users.avatar','chats.updated_at','mensajes.message','mensajes.leido')->where([
            ['user_login_1', Auth::user()->login],
            ['send_username', Auth::user()->login],
        ])->join('users','chats.user_login_2', '=', 'users.login')->join('mensajes','sender_username', '=', 'users.login')->groupBy('users.login')->orderBy('chats.updated_at','DESC')->get();

        if(empty($tuschats1)){
            $tuschats = $tuschats2;
        }elseif (empty($tuschats2)){
            $tuschats = $tuschats1;
        }else{
            $tuschats = $tuschats1->merge($tuschats2);
        }

        $data = array(
            'chats' => $tuschats

        );

        return view('mismensajes')->with($data);
    }

    public function comprobar($login){

        $loginChatT = Auth::user()->login; //Login del usuario

        if($login == $loginChatT){
            return redirect()->action('HomeController@index');
        }
                
       $existe1 = DB::table('chats')->where([
            ['user_login_1', '=',$login],
            ['user_login_2', '=',$loginChatT],
        ])->first();

        $existe2 = DB::table('chats')->where([
            ['user_login_1', '=',$loginChatT],
            ['user_login_2', '=',$login],
        ])->first();

        if($existe1 || $existe2){
            return redirect('mensajes/');
        }else{
            DB::table('chats')->insert([

                'user_login_1' => $login,
                'user_login_2' => $loginChatT,
                ]);
            return redirect()->action('ChatController@cargarMensajes',[$login]);
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
        $login = Auth::user()->login;
         if($txt == ''){
             return redirect()->action('ChatController@cargarMensajes',[$sender,'u' => 2]);
         }
        $mensaje = array(
            'send_username' => $login,
            'sender_username' => $sender,
            'message' => $txt
        );
        try{
            DB::enableQueryLog();

            DB::table('mensajes')->insert($mensaje);

            DB::table('chats')->where([
                    ['user_login_1', '=', $sender],
                    ['user_login_2', '=',$login],
                ])->orWhere([
                    ['user_login_1', '=',$login],
                    ['user_login_2', '=',$sender],
                ])->update(['updated_at' => date('Y-m-d H:i:s')]);

            return redirect()->action('ChatController@cargarMensajes',[$sender,'u' => 1]);
        }catch (Exception $e){
            return redirect()->action('ChatController@cargarMensajes',[$sender,'u' => 0]);
        }
     }
}


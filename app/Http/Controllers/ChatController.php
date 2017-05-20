<?php

namespace App\Http\Controllers;

use App\Chats;
use App\Mensajes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class ChatController extends Controller
{
    public function index(){

        $tuschats1 = DB::table('chats')->where('user_id_2', Auth::user()->id)->join('users','chats.user_id_1', '=', 'users.id')->pluck('login');
        $tuschats2 = DB::table('chats')->where('user_id_1', Auth::user()->id)->join('users','chats.user_id_2', '=', 'users.id')->pluck('login');

        $tuschats = $tuschats1->merge($tuschats2);


        $data = array(
            'chats' => $tuschats

        );

        return view('mismensajes')->with($data);
    }

    public function comprobar($login){

        $idChatT = Auth::user()->id;

        $loginChatU = $login;

        $idChatU = DB::table('users')->where('login', $loginChatU)->first();

       $existe1 = DB::table('chats')->where([
            ['user_id_1', '=',$idChatU->id],
            ['user_id_2', '=',$idChatT],
        ])->first();

        $existe2 = DB::table('chats')->where([
            ['user_id_1', '=',$idChatT],
            ['user_id_2', '=',$idChatU->id],
        ])->first();

        if($existe1 || $existe2){
            return redirect('mensajes/'.$idChatU->login);
        }else{
            DB::table('chats')->insert([

                'user_id_1' => $idChatU->id,
                'user_id_2' => $idChatT,
                ]);
            return redirect('mensajes/'.$idChatU->login);
        }
    }

    public function sendMessage()
    {
        $username = Input::get('username');
        $text = Input::get('text');

        $chatMessage = new Mensajes();
        $chatMessage->sender_username = $username;
        $chatMessage->message = $text;
        $chatMessage->save();
    }

    public function isTyping()
    {
        $username = Input::get('username');

        $chat = Chats::find(1);
        if ($chat->user1 == $username)
            $chat->user1_is_typing = true;
        else
            $chat->user2_is_typing = true;
        $chat->save();
    }

    public function notTyping()
    {
        $username = Input::get('username');

        $chat = Chats::find(1);
        if ($chat->user1 == $username)
            $chat->user1_is_typing = false;
        else
            $chat->user2_is_typing = false;
        $chat->save();
    }

    public function retrieveChatMessages()
    {
        $username = Input::get('username');

        $message = Mensajes::where('sender_username', '!=', $username)->where('leido', '=', false)->first();

        if (count($message) > 0)
        {
            $message->leido = true;
            $message->save();
            return $message->message;
        }
    }

    public function retrieveTypingStatus()
    {
        $username = Input::get('username');

        $chat = Chats::find(1);
        if ($chat->user1 == $username)
        {
            if ($chat->user2_is_typing)
                return $chat->user2;
        }
        else
        {
            if ($chat->user1_is_typing)
                return $chat->user1;
        }
    }
}


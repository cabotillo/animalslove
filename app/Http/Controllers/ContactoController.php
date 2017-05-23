<?php

namespace App\Http\Controllers;


use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ContactoController extends Controller
{
    //

    public function index(){

        return view('contacto');
    }

    public function enviar(){

        $validation = Validator::make(Input::all(), [
            'nombre' => 'required_without:login|string|max:25',
            'login' => 'required_without:nombre|string|max:25',
            'email' => 'required|string|max:50',
            'asunto' => 'required|string|max:25',
            'mensaje' => 'required|string|max:250',
            'invi' => 'required|string|max:3'
        ]);

        if($validation->fails()) {
            //withInput keep the users info
            return Redirect::back()->withInput()->withErrors($validation->messages());
        } else {

            $invi = Input::get('invi');
            if($invi == 'si'){

                $nombre = Input::get('nombre');
                $email = Input::get('email');
                $asunto = Input::get('asunto');
                $mensaje = Input::get('mensaje');

                $data = array(
                    'nombre' => $nombre,
                    'email' => $email,
                    'asunto' => $asunto,
                    'mensaje' => $mensaje
                );


            }else if($invi == 'no'){
                $nombre = Input::get('login');
                $email = Input::get('email');
                $asunto = Input::get('asunto');
                $mensaje = Input::get('mensaje');

                //return (new MailMessage)->subject($asunto)->from($email,$nombre)->line($mensaje);

            }


         return view('contacto')->with('mensaje','Ha sido enviado el mensaje, le responderemos en breve.');
        }
    }
}

<?php

namespace App\Http\Controllers;


use App\Mail\SoporteMail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\Mail\ContactoMail;

class ContactoController extends Controller
{
    //

    public function index(){

        return view('contacto');
    }

    public function enviar(){

        if(Input::get('usu') == 'invitado'){

            $validation = Validator::make(Input::all(), [
                'nombre' => 'required|string|max:25',
                'correo' => 'required|email|max:50',
                'asunto' => 'required|string|max:50',
                'cuerpo' => 'required|string|max:250',
                'g-recaptcha-response' => 'required|recaptcha',
            ]);

            if($validation->fails()) {
                //withInput keep the users info
                return Redirect::back()->withInput()->withErrors($validation->messages());
            } else {

                $data = array(
                    $nombre = Input::get('nombre'),
                    $email = Input::get('correo'),
                    $asunto = Input::get('asunto'),
                    $mensaje = Input::get('cuerpo'),
                );
            }

        }elseif(Input::get('usu') == 'usuario') {

            $validation = Validator::make(Input::all(), [
                'asunto' => 'required|string|max:50',
                'cuerpo' => 'required|string|max:250',
                'g-recaptcha-response' => 'required|recaptcha',
            ]);

            if ($validation->fails()) {
                //withInput keep the users info
                return Redirect::back()->withInput()->withErrors($validation->messages());
            } else {
                $data = array(
                    $nombre = Auth::user()->nombre,
                    $email = Auth::user()->email,
                    $asunto = Input::get('asunto'),
                    $mensaje = Input::get('cuerpo'),
                );

            }
        }

            Mail::to($email)->send(new ContactoMail()); //Mail para el usuario
            Mail::to('animalslovees@gmail.com')->send(new SoporteMail($data)); //Mail para la web


         return view('contacto')->with('mensaje','Ha sido enviado el mensaje, le responderemos en breve.');
    }
}

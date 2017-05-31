<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SoporteMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        //
        //print_r($data);die();
        $this->datos = array(
            'correo' => $data[1],
            'asunto' => $data[2],
            'mensaje' => $data[3],
        );
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.soporte')
            ->subject('Alguien le ha enviado un mensaje')
            ->from('animalslovees@gmail.com','AnimalsLove')->with($this->datos);
    }
}

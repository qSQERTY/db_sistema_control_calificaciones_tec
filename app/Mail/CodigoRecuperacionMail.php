<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class CodigoRecuperacionMail extends Mailable
{
    public $codigo;

    public function __construct($codigo)
    {
        $this->codigo = $codigo;
    }

    public function build()
    {
        return $this
            ->subject('Código para recuperar contraseña')
            ->view('emails.codigo-recuperacion');
    }
}
<?php


namespace App\Mail;


use App\Models\Estudiante;
use App\Models\Examen;
use App\Models\Calificacion;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class ResultadoExamenMail extends Mailable
{

    use Queueable, SerializesModels;


    public $estudiante;

    public $examen;

    public $calificacion;

    public $mensaje;

    public $asunto;



    public function __construct(
        Estudiante $estudiante,
        Examen $examen,
        Calificacion $calificacion = null,
        $asunto = 'Resultado de examen - TecNM',
        $mensaje = null
    )
    {

        $this->estudiante = $estudiante;

        $this->examen = $examen;

        $this->calificacion = $calificacion;

        $this->asunto = $asunto;



        if($mensaje){

            $this->mensaje = $mensaje;

        }else{

            $this->mensaje = 
            'Se ha generado una notificación de su resultado académico.';

        }

    }



    public function build()
    {

        return $this->subject($this->asunto)

                    ->view('emails.resultado-examen');

    }

}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Estudiante;
use App\Models\Anio;
use App\Models\Calificacion;

class Examen extends Model
{
    protected $table = 'examenes';


    protected $fillable = [

        'estudiante_id',
        'anio_id',
        'tipo_examen',
        'intento',
        'pago',
        'fecha',
        'folio',
        'comprobante_pago'

    ];


    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class);
    }


    public function anio()
    {
        return $this->belongsTo(Anio::class);
    }


    public function resultadoCalificacion()
    {
        return $this->hasOne(Calificacion::class);
    }
}
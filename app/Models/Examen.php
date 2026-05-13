<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
        'resultado',
        'calificacion'
    ];
}
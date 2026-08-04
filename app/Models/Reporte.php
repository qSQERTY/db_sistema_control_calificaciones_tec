<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    protected $table = 'reportes';

    protected $fillable = [
        'numero_control',
        'nombre_completo',
        'carrera',
        'horario',
        'tipo_alumno',
        'calificacion_final'
        
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    protected $table = 'estudiantes';

    protected $fillable = [
        'numero_control',
        'nombre_completo',
        'carrera',
        'horario',
        'tipo_alumno'
    ];
}
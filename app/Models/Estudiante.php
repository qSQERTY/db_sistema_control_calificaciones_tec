<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use App\Models\Carrera;

class Estudiante extends Model
{
    protected $table = 'estudiantes';

    protected $fillable = [
    'numero_control',
    'nombre_completo',
    'correo',
    'carrera_id',
    'horario',
    'tipo_alumno'
];
  public function carrera()
{
    return $this->belongsTo(Carrera::class);
}


public function examenes()
{
    return $this->hasMany(Examen::class, 'estudiante_id');
}


public function calificaciones()
{
    return $this->hasMany(Calificacion::class, 'estudiante_id');
}
}

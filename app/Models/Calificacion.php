<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Examen;

class Calificacion extends Model
{
    protected $table = 'calificaciones';

    protected $fillable = [

        'examen_id',

        'nivel_ubicacion',

        'reading',

        'listening',

        'writing',

        'speaking',

        'promedio',

        'toefl',

        'speaking_certificacion'

    ];

    public function examen()
    {
        return $this->belongsTo(Examen::class);
    }
}
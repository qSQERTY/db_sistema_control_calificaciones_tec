<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anio extends Model
{
    protected $table = 'anios';

    protected $fillable = [
        'anio',
        'activo'
    ];

    public function examenes()  
    {
        return $this->hasMany(Examen::class, 'anio_id');
    }
}
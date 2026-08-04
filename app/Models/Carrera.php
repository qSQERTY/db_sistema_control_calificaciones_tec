<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Estudiante;

class Carrera extends Model
{
    protected $fillable = ['nombre'];

    public function estudiantes()
    {
        return $this->hasMany(Estudiante::class);
    }
}
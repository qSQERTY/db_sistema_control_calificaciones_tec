<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CodigoRecuperacion extends Model
{
    protected $table = 'codigos_recuperacion';

    protected $fillable = [

        'email',

        'codigo',

        'expira_en'

    ];

    protected $casts = [

        'expira_en' => 'datetime'

    ];
}
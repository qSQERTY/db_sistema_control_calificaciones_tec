<?php

namespace App\Http\Controllers;

use App\Models\Anio;

class CalendarioController extends Controller
{
    public function index()
{
    $anio = Anio::with([
        'examenes.estudiante.carrera',
        'examenes.resultadoCalificacion'
    ])
    ->where('activo', 1)
    ->firstOrFail();

    $anios = Anio::orderBy('anio', 'desc')->get();

    $fechaInicial = $anio->examenes()
        ->orderBy('fecha')
        ->value('fecha');

    return view(
        'registro-estudiantes',
        compact('anio', 'anios', 'fechaInicial')
    );
}
}
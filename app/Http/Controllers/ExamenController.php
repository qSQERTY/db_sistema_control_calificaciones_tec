<?php

namespace App\Http\Controllers;

use App\Models\Examen;
use App\Models\Estudiante;
use App\Models\Anio;
use Illuminate\Http\Request;

class ExamenController extends Controller
{
    public function index()
    {
        $estudiantes = Estudiante::all();
        $anios = Anio::all();

        return view('examenes', compact(
            'estudiantes',
            'anios'
        ));
    }

    public function store(Request $request)
    {
        $intentos = Examen::where(
            'estudiante_id',
            $request->estudiante_id
        )->count();

        if ($intentos >= 3) {
            return back()->with(
                'error',
                'El alumno ya alcanzó el máximo de intentos'
            );
        }

        Examen::create([

            'estudiante_id' => $request->estudiante_id,
            'anio_id' => $request->anio_id,
            'tipo_examen' => $request->tipo_examen,
            'intento' => $intentos + 1,
            'pago' => $request->pago,
            'fecha' => $request->fecha,
            'resultado' => $request->resultado,
            'calificacion' => $request->calificacion

        ]);

        return back();
    }
}
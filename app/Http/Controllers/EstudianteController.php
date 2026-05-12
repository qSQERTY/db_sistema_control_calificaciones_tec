<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estudiante;

class EstudianteController extends Controller
{
    public function index()
    {
        $estudiantes = Estudiante::all();

        return view('estudiantes.index', compact('estudiantes'));
    }

    public function create()
    {
        return view('estudiantes.create');
    }

    public function store(Request $request)
    {
        Estudiante::create([
            'numero_control' => $request->numero_control,
            'nombre_completo' => $request->nombre_completo,
            'carrera' => $request->carrera,
            'horario' => $request->horario,
            'tipo_alumno' => $request->tipo_alumno,
        ]);

        return redirect('/estudiantes');
    }
}
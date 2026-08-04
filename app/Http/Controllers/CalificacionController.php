<?php

namespace App\Http\Controllers;

use App\Models\Calificacion;
use App\Models\Examen;
use Illuminate\Http\Request;

class CalificacionController extends Controller
{
    public function index()
    {
        $examenesPendientes = Examen::with([
            'estudiante',
            'resultadoCalificacion'
        ])
        ->doesntHave('resultadoCalificacion')
        ->orderBy('fecha', 'desc')
        ->get();

        $calificaciones = Calificacion::with([
            'examen.estudiante'
        ])
        ->orderBy('created_at', 'desc')
        ->get();

        return view('calificaciones.index', compact(
            'examenesPendientes',
            'calificaciones'
        ));
    }

    public function create($id)
    {
        $examen = Examen::with('estudiante')->findOrFail($id);

        return view('calificaciones.create', compact('examen'));
    }

    public function store(Request $request)
{
    $request->validate([
        'examen_id' => 'required|exists:examenes,id'
    ]);

    // Evitar duplicar calificaciones
    $existe = Calificacion::where('examen_id', $request->examen_id)->exists();

    if ($existe) {
        return redirect('/calificaciones')
            ->with('error', 'Este examen ya tiene una calificación registrada.');
    }


    $examen = Examen::findOrFail($request->examen_id);


    $tipo = match ($examen->tipo_examen) {

        'Examen de Ubicación' => 'ubicacion',

        'Examen General de 4 Habilidades' => '4_habilidades',

        'TOEFL ITP' => 'toefl',

        'Speaking por Certificación' => 'speaking_certificacion',

        default => '4_habilidades'
    };


    $promedio = null;
    $resultado = null;


    switch ($tipo) {


        case 'ubicacion':

            $resultado = 'Nivel ' . $request->nivel_ubicacion;

            break;



        case '4_habilidades':

            $promedio = (
                ($request->reading ?? 0) +
                ($request->listening ?? 0) +
                ($request->writing ?? 0) +
                ($request->speaking ?? 0)
            ) / 4;


            $resultado = $promedio >= 6
                ? 'Aprobado'
                : 'Reprobado';

            break;



        case 'toefl':

            $resultado = 'Puntaje registrado';

            break;



        case 'speaking_certificacion':

            $resultado = $request->speaking_certificacion >= 6
                ? 'Aprobado'
                : 'Reprobado';

            break;
    }



    Calificacion::create([

        'examen_id' => $request->examen_id,

        'nivel_ubicacion' => $request->nivel_ubicacion,

        'reading' => $request->reading,

        'listening' => $request->listening,

        'writing' => $request->writing,

        'speaking' => $request->speaking,

        'promedio' => $promedio,

        'toefl' => $request->toefl,

        'speaking_certificacion' => $request->speaking_certificacion

    ]);



    $examen->resultado = $resultado;
    $examen->save();



    return redirect('/calificaciones')
        ->with(
            'success',
            'Calificación guardada correctamente'
        );
}
    public function edit($id)
    {
        $calificacion = Calificacion::with([
            'examen.estudiante'
        ])->findOrFail($id);

        return view('calificaciones.edit', compact('calificacion'));
    }
    public function update(Request $request, $id)
{
    $request->validate([
        'examen_id' => 'required|exists:examenes,id'
    ]);

    $calificacion = Calificacion::findOrFail($id);

    $examen = Examen::findOrFail($request->examen_id);

    $tipo = match ($examen->tipo_examen) {

        'Examen de Ubicación' => 'ubicacion',

        'Examen General de 4 Habilidades' => '4_habilidades',

        'TOEFL ITP' => 'toefl',

        'Speaking por Certificación' => 'speaking_certificacion',

        default => '4_habilidades'

    };

    $promedio = (
        ($request->reading ?? 0) +
        ($request->listening ?? 0) +
        ($request->writing ?? 0) +
        ($request->speaking ?? 0)
    ) / 4;

    $resultado = null;

    switch ($tipo) {

        case 'ubicacion':

            $resultado = 'Nivel ' . $request->nivel_ubicacion;

            break;

        case '4_habilidades':

            $resultado = $promedio >= 6
                ? 'Aprobado'
                : 'Reprobado';

            break;

        case 'toefl':

            $resultado = 'Puntaje registrado';

            break;

        case 'speaking_certificacion':

            $resultado = $request->speaking_certificacion >= 6
                ? 'Aprobado'
                : 'Reprobado';

            break;
    }

    $calificacion->update([

        'nivel_ubicacion' => $request->nivel_ubicacion,

        'reading' => $request->reading,

        'listening' => $request->listening,

        'writing' => $request->writing,

        'speaking' => $request->speaking,

        'promedio' => $promedio,

        'toefl' => $request->toefl,

        'speaking_certificacion' => $request->speaking_certificacion

    ]);

    $examen->resultado = $resultado;
    $examen->save();

    return redirect()
        ->route('calificaciones.index')
        ->with(
            'success',
            'Calificación actualizada correctamente.'
        );
}

public function destroy($id)
{
    $calificacion = Calificacion::findOrFail($id);

    $calificacion->delete();

    return redirect()
        ->route('calificaciones.index')
        ->with(
            'success',
            'Calificación eliminada correctamente.'
        );
}

}
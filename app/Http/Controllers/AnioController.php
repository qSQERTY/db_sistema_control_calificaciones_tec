<?php

namespace App\Http\Controllers;

use App\Models\Anio;
use App\Models\Examen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Calificacion;

class AnioController extends Controller
{
    public function index()
    {
        $anios = Anio::where('activo', true)
            ->orderBy('anio', 'asc')
            ->get();

        $historial = Anio::where('activo', false)
            ->orderBy('anio', 'asc')
            ->get();

        return view('panel', compact('anios', 'historial'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'anio' => 'required|unique:anios,anio'
        ]);

        Anio::create([
            'anio' => $request->anio,
            'activo' => true
        ]);

        return redirect('/panel');
    }

   

    public function show($id)
{
    $anios = Anio::where('activo', true)
        ->orderBy('anio')
        ->get();


    $anio = Anio::with([
        'examenes.estudiante',
        'examenes.resultadoCalificacion'
    ])->findOrFail($id);


    return view('registro-estudiantes', compact('anio', 'anios'));
}

    public function destroy($id)
    {
        $anio = Anio::findOrFail($id);

        $anio->activo = false;
        $anio->save();

        return redirect('/panel')
            ->with('success', 'Año enviado al historial');
    }

    public function activar($id)
    {
        $anio = Anio::findOrFail($id);

        $anio->activo = true;
        $anio->save();

        return redirect('/panel')
            ->with('success', 'Año reactivado');
    }
   public function eliminar(Request $request, $id)
{
    $anio = Anio::with('examenes')->findOrFail($id);

    /*
    |---------------------------------------------------------
    | Si tiene exámenes y aún no confirma
    |---------------------------------------------------------
    */

    if (
        $anio->examenes->count() > 0 &&
        !$request->has('confirmar')
    ) {

        return back()->with(
            'confirmarEliminar',
            [
                'id' => $anio->id,
                'anio' => $anio->anio,
                'cantidad' => $anio->examenes->count()
            ]
        );

    }

    DB::transaction(function () use ($anio) {

        foreach ($anio->examenes as $examen) {

            /*
            |--------------------------------------------
            | Eliminar calificación
            |--------------------------------------------
            */

            Calificacion::where(
                'examen_id',
                $examen->id
            )->delete();


            /*
            |--------------------------------------------
            | Eliminar comprobante
            |--------------------------------------------
            */

            if (
                $examen->comprobante_pago &&
                Storage::disk('public')->exists($examen->comprobante_pago)
            ) {

                Storage::disk('public')
                    ->delete($examen->comprobante_pago);

            }


            /*
            |--------------------------------------------
            | Eliminar examen
            |--------------------------------------------
            */

            $examen->delete();

        }


        /*
        |--------------------------------------------
        | Eliminar año
        |--------------------------------------------
        */

        $anio->delete();

    });


    return redirect('/panel')
        ->with(
            'success',
            'El año y todos sus registros fueron eliminados correctamente.'
        );
}
}
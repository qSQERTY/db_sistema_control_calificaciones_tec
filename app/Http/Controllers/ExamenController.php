<?php

namespace App\Http\Controllers;

use App\Models\Examen;
use App\Models\Estudiante;
use App\Models\Anio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResultadoExamenMail;


class ExamenController extends Controller
{

public function index(Request $request)
{
    $buscar = $request->buscar;


    $examenes = Examen::with([
    'estudiante',
    'resultadocalificacion'
    ])
    ->when($buscar, function ($query) use ($buscar) {

        $query->whereHas('estudiante', function ($q) use ($buscar) {

            $q->where('nombre_completo', 'like', "%{$buscar}%");

        });

    })
    ->orderBy('fecha', 'desc')
    ->get();


    return view('examenes-index', compact('examenes'));
}



public function formulario()
{
    $estudiantes = Estudiante::all();


    return view(
        'examenes',
        compact('estudiantes')
    );
}



public function store(Request $request)
{
    $request->validate([

        'estudiante_id' => 'required',
        'tipo_examen' => 'required',
        'fecha' => 'required',
        'comprobante_pago' => 'nullable|file'

    ]);


    /*
    |--------------------------------------------------------------------------
    | Máximo 3 intentos por tipo de examen
    |--------------------------------------------------------------------------
    */

    $intentos = Examen::where('estudiante_id', $request->estudiante_id)
        ->where('tipo_examen', $request->tipo_examen)
        ->count();

    if ($intentos >= 3) {

        return back()->with(
            'error',
            'El alumno ya alcanzó el máximo de 3 intentos para este examen. Debe esperar 6 meses para presentarlo nuevamente.'
        );

    }

    $intento = $intentos + 1;


    /*
    |--------------------------------------------------------------------------
    | Detectar año automáticamente
    |--------------------------------------------------------------------------
    */

    $anioNumero = date(
        'Y',
        strtotime($request->fecha)
    );

    $anio = Anio::where(
        'anio',
        $anioNumero
    )->first();


    /*
    |--------------------------------------------------------------------------
    | Pago automático
    |--------------------------------------------------------------------------
    */

    $comprobante = null;

    $pago = false;

    if ($request->hasFile('comprobante_pago')) {

        $comprobante = $request
            ->file('comprobante_pago')
            ->store('comprobantes', 'public');

        $pago = true;

    }


    /*
    |--------------------------------------------------------------------------
    | Generar folio
    |--------------------------------------------------------------------------
    */

    $folio = 'EX-' .
              $anioNumero .
              '-' .
              str_pad(
                  Examen::count() + 1,
                  4,
                  '0',
                  STR_PAD_LEFT
              );


    /*
    |--------------------------------------------------------------------------
    | Guardar examen
    |--------------------------------------------------------------------------
    */

    Examen::create([

        'estudiante_id' => $request->estudiante_id,

        'anio_id' => $anio->id,

        'tipo_examen' => $request->tipo_examen,

        'intento' => $intento,

        'pago' => $pago,

        'fecha' => $request->fecha,

        'folio' => $folio,

        'comprobante_pago' => $comprobante

    ]);


    return back()->with(
        'success',
        'Examen registrado correctamente'
    );
}


public function enviarResultado($id)
{
    $examen = Examen::with([
        'estudiante',
        'Calificacion'
    ])
    ->findOrFail($id);



    Mail::to($examen->estudiante->correo)
        ->send(
            new ResultadoExamenMail(
                $examen->estudiante,
                $examen
            )
        );



    return back()
        ->with(
            'success',
            'Notificación enviada correctamente'
        );

}
public function destroy($id)
{
    $examen = Examen::findOrFail($id);

    $examen->delete();


    return redirect()
        ->route('examenes.index')
        ->with(
            'success',
            'Examen eliminado correctamente.'
        );
}




public function edit($id)
{
    $examen = Examen::findOrFail($id);

    $estudiantes = Estudiante::all();


    return view(
        'examenes-edit',
        compact(
            'examen',
            'estudiantes'
        )
    );
}




public function update(Request $request, $id)
{
    $request->validate([

        'estudiante_id' => 'required',

        'tipo_examen' => 'required',

        'fecha' => 'required',

        'comprobante_pago' => 'nullable|file'

    ]);



    $examen = Examen::findOrFail($id);



    /*
    |--------------------------------------------------------------------------
    | Actualizar comprobante si se subió uno nuevo
    |--------------------------------------------------------------------------
    */


    if ($request->hasFile('comprobante_pago')) {


        $comprobante = $request
            ->file('comprobante_pago')
            ->store('comprobantes', 'public');


        $examen->comprobante_pago = $comprobante;


        $examen->pago = true;

    }



    /*
    |--------------------------------------------------------------------------
    | Actualizar datos
    |--------------------------------------------------------------------------
    */


    $examen->estudiante_id = $request->estudiante_id;


    $examen->tipo_examen = $request->tipo_examen;


    $examen->fecha = $request->fecha;



    $examen->save();



    return redirect()
        ->route('examenes.index')
        ->with(
            'success',
            'Examen actualizado correctamente.'
        );

}




public function verComprobante($id)
{
    $examen = Examen::findOrFail($id);



    $archivo = storage_path(
        'app/public/' . $examen->comprobante_pago
    );



    if (!file_exists($archivo)) {

        abort(
            404,
            'Archivo no encontrado'
        );

    }



    return response()->file($archivo);

}


}
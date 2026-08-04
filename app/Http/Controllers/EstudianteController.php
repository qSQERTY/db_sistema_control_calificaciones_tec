<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estudiante;
use App\Models\Carrera;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResultadoExamenMail;

class EstudianteController extends Controller
{
    public function index(Request $request)
{

    $buscar = $request->buscar;


    $estudiantes = Estudiante::with('carrera')

        ->when($buscar, function ($query) use ($buscar) {

            $query->where('nombre_completo', 'like', "%{$buscar}%")

                  ->orWhere('numero_control', 'like', "%{$buscar}%");

        })

        ->orderBy('nombre_completo')

        ->paginate(10);


    return view(
        'estudiantes.index',
        compact('estudiantes')
    );

}

    public function create()
    {
        $carreras = Carrera::orderBy('nombre')->get();

        return view('estudiantes.create', compact('carreras'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'numero_control' => 'required|unique:estudiantes,numero_control',
            'nombre_completo' => 'required|string|max:255',
            'correo' => 'required|email|unique:estudiantes,correo',
            'carrera_id' => 'required|exists:carreras,id',
            'horario' => 'required',
            'tipo_alumno' => 'required',
        ]);

        Estudiante::create([
            'numero_control' => $request->numero_control,
            'nombre_completo' => $request->nombre_completo,
            'correo' => $request->correo,
            'carrera_id' => $request->carrera_id,
            'horario' => $request->horario,
            'tipo_alumno' => $request->tipo_alumno,
        ]);

        return redirect('/estudiantes')
            ->with('success', 'Estudiante registrado correctamente.');
    }

    public function show($id)
    {
        $estudiante = Estudiante::with('carrera')->findOrFail($id);

        return view('estudiantes.show', compact('estudiante'));
    }

    public function edit($id)
{
    $estudiante = Estudiante::findOrFail($id);

    $carreras = Carrera::orderBy('nombre')->get();

    return view(
        'estudiantes.edit',
        compact('estudiante', 'carreras')
    );
}

    public function update(Request $request, $id)
    {
        $estudiante = Estudiante::findOrFail($id);

        $request->validate([
            'numero_control' => 'required|unique:estudiantes,numero_control,' . $id,
            'nombre_completo' => 'required|string|max:255',
            'correo' => 'required|email|unique:estudiantes,correo,' . $id,
            'carrera_id' => 'required|exists:carreras,id',
            'horario' => 'required',
            'tipo_alumno' => 'required',
        ]);

        $estudiante->update([
            'numero_control' => $request->numero_control,
            'nombre_completo' => $request->nombre_completo,
            'correo' => $request->correo,
            'carrera_id' => $request->carrera_id,
            'horario' => $request->horario,
            'tipo_alumno' => $request->tipo_alumno,
        ]);

        return redirect()->route('estudiantes.index')
            ->with('success', 'Estudiante actualizado correctamente.');
    }
    public function notificar($id)
{

    $estudiante = Estudiante::findOrFail($id);


    $examen = $estudiante->examenes()
                         ->latest()
                         ->first();


    $calificacion = null;


    if($examen){

        $calificacion = $examen->resultadoCalificacion;

    }



    Mail::to($estudiante->correo)
        ->send(

            new ResultadoExamenMail(
                $estudiante,
                $examen,
                $calificacion
            )

        );



    return redirect()
        ->route('panel')
        ->with(
            'success',
            'Resultado enviado correctamente'
        );

}
    public function destroy($id)
    {
        $estudiante = Estudiante::findOrFail($id);
        $estudiante->delete();

        return redirect()->route('estudiantes.index')
            ->with('success', 'Estudiante eliminado correctamente.');
    }
    public function editarNotificacion($id)
{
    $estudiante = Estudiante::findOrFail($id);


    return view(
        'estudiantes.editar-notificacion',
        compact('estudiante')
    );
}
public function enviarNotificacion(Request $request, $id)
{

    $request->validate([

        'asunto'=>'required|string|max:255',

        'mensaje'=>'required|string'

    ]);


    $estudiante = Estudiante::findOrFail($id);


    $examen = $estudiante->examenes()
                         ->latest()
                         ->first();


    $calificacion = null;


    if($examen){

        $calificacion = $examen->resultadoCalificacion;

    }



    Mail::to($estudiante->correo)
        ->send(
            new ResultadoExamenMail(
                $estudiante,
                $examen,
                $calificacion,
                $request->asunto,
                $request->mensaje
            )
        );


    return redirect()
        ->route('panel')
        ->with(
            'success',
            'Notificación enviada correctamente'
        );

}
}
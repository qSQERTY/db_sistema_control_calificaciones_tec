<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use Illuminate\Http\Request;
use App\Models\Estudiante;

class CarreraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
{
    $carreras = Carrera::orderBy('nombre')->get();

    return view('carreras.index', compact('carreras'));
}

public function create()
{
    return view('carreras.create');
}

public function store(Request $request)
{
    $request->validate([
        'nombre' => 'required|string|max:255|unique:carreras,nombre',
    ]);

    Carrera::create([
        'nombre' => $request->nombre,
    ]);

    return redirect()->route('carreras.index')
                     ->with('success', 'Carrera agregada correctamente.');
}

public function show(Carrera $carrera)
{
    return view('carreras.show', compact('carrera'));
}

public function edit(Carrera $carrera)
{
    return view('carreras.edit', compact('carrera'));
}

public function update(Request $request, Carrera $carrera)
{
    $request->validate([
        'nombre' => 'required|string|max:255|unique:carreras,nombre,' . $carrera->id,
    ]);

    $carrera->update([
        'nombre' => $request->nombre,
    ]);

    return redirect()->route('carreras.index')
                     ->with('success', 'Carrera actualizada correctamente.');
}

public function destroy(Carrera $carrera)
{
    if ($carrera->estudiantes()->count() > 0) {
        return redirect()->route('carreras.index')
                         ->with('error', 'No se puede eliminar la carrera porque tiene estudiantes registrados.');
    }

    $carrera->delete();

    return redirect()->route('carreras.index')
                     ->with('success', 'Carrera eliminada correctamente.');
}
   public function estudiantes()
    {
        return $this->hasMany(Estudiante::class);
    }
}

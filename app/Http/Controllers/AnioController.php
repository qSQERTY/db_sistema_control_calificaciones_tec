<?php

namespace App\Http\Controllers;

use App\Models\Anio;
use Illuminate\Http\Request;

class AnioController extends Controller
{
    public function index()
    {
        $anios = Anio::orderBy('anio', 'asc')->get();

    return view('panel', compact('anios'));
    }

    public function store(Request $request)
    {
    $request->validate([
        'anio' => 'required|unique:anios,anio'
        ]);

    Anio::create([
        'anio' => $request->anio
        ]);

    return redirect('/panel');
    }

    public function show($anio)
    {
    $anios = Anio::orderBy('anio', 'asc')->get();

    return view('anio', compact('anio', 'anios'));
    }
}

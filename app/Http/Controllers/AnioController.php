<?php

namespace App\Http\Controllers;

use App\Models\Anio;
use Illuminate\Http\Request;

class AnioController extends Controller
{
    public function index()
    {
        $anios = Anio::orderBy('anio', 'asc')->get();

        return view('dashboard', compact('anios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'anio' => 'required|unique:años,anio'
        ]);

        Anio::create([
            'anio' => $request->anio
        ]);

        return back();
    }
}
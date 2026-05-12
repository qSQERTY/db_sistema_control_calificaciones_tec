<?php

namespace App\Http\Controllers;

use App\Models\Anio;
use Illuminate\Http\Request;

class AnioController extends Controller
{
    public function index()
    {
        $anios = Anio::orderBy('año', 'asc')->get();

        return view('dashboard', compact('años'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'año' => 'required|unique:años,año'
        ]);

        Anio::create([
            'año' => $request->año
        ]);

        return back();
    }
}
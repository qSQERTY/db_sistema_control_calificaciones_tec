<?php

namespace App\Http\Controllers;

use App\Models\Año;
use Illuminate\Http\Request;

class AñoController extends Controller
{
    public function index()
    {
        $años = Año::orderBy('año', 'asc')->get();

        return view('dashboard', compact('años'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'año' => 'required|unique:años,año'
        ]);

        Año::create([
            'año' => $request->año
        ]);

        return back();
    }
}
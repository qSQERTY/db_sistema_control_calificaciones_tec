<?php

namespace App\Http\Controllers;

use App\Models\CodigoRecuperacion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Mail\CodigoRecuperacionMail;
use Carbon\Carbon;

class PasswordController extends Controller
{
    public function formCorreo()
    {
        return view('auth.forgot-password');
    }

    public function formCodigo()
    {
        return view('auth.verificar-codigo');
    }

    public function formNuevaPassword()
    {
        return view('auth.nueva-password');
    }
    public function enviarCodigo(Request $request)
{
    $request->validate([
        'email' => 'required|email'
    ]);

    $usuario = User::where('email', $request->email)->first();

    if (!$usuario) {

        return back()->withErrors([
            'email' => 'No existe una cuenta con ese correo.'
        ]);

    }

    // Elimina códigos anteriores
    CodigoRecuperacion::where('email', $request->email)->delete();

    // Genera código
    $codigo = random_int(100000, 999999);

    // Guarda el código
    CodigoRecuperacion::create([
        'email' => $request->email,
        'codigo' => $codigo,
        'expira_en' => Carbon::now()->addMinutes(10)
    ]);

    // Envía el correo
    Mail::to($request->email)
        ->send(new CodigoRecuperacionMail($codigo));

    return redirect()->route('password.codigo')
        ->with('email', $request->email);
}
public function verificarCodigo(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'codigo' => 'required'
    ]);

    $registro = CodigoRecuperacion::where('email', $request->email)
        ->where('codigo', $request->codigo)
        ->first();

    if (!$registro) {

        return back()->withErrors([
            'codigo' => 'El código es incorrecto.'
        ]);

    }

    if (now()->greaterThan($registro->expira_en)) {

        $registro->delete();

        return back()->withErrors([
            'codigo' => 'El código ha expirado.'
        ]);

    }

    session([
        'correo_recuperacion' => $request->email
    ]);

    return redirect()->route('password.nueva');
}
public function guardarPassword(Request $request)
{
    $request->validate([
        'password' => 'required|min:8|confirmed'
    ]);

    $email = session('correo_recuperacion');

    if (!$email) {

        return redirect()->route('password.request');

    }

    $usuario = User::where('email', $email)->first();

    if (!$usuario) {

        return redirect()->route('password.request');

    }

    $usuario->password = Hash::make($request->password);

    $usuario->save();

    CodigoRecuperacion::where('email', $email)->delete();

    session()->forget('correo_recuperacion');

    return redirect()
            ->route('login')
            ->with('success', 'La contraseña se actualizó correctamente. Ya puedes iniciar sesión.');
}
}
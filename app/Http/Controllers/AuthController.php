<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{
    public function login(Request $request)
{

    $credentials = $request->validate([
        'email'=>'required|email',
        'password'=>'required'
    ]);


    if(Auth::attempt(
        $credentials,
        $request->boolean('remember')
    )){

        $request->session()->regenerate();

        return redirect('/panel');

    }


    return back()->withErrors([
        'email'=>'Credenciales incorrectas'
    ]);

}
public function register(Request $request)
{

    $data = $request->validate([

        'name'=>'required|string|max:255',

        'email'=>'required|email|unique:users',

        'password'=>'required|min:8|confirmed'

    ]);


    User::create([

        'name'=>$data['name'],

        'email'=>$data['email'],

        'password'=>Hash::make($data['password'])

    ]);


    return redirect('/login')
        ->with('success','Perfil creado correctamente');

}
    
}
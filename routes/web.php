<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\AnioController;
use App\Http\Controllers\ExamenController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\CarreraController;
use App\Http\Controllers\CalendarioController;
use App\Models\Estudiante;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\CalificacionController;
use App\Http\Controllers\PasswordController;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;
use App\Http\Controllers\GoogleAuthController;

/*
|--------------------------------------------------------------------------
| Inicio de sesión y registro
|--------------------------------------------------------------------------
*/
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.request');


Route::post('/forgot-password', function (Request $request) {

    $request->validate([
        'email' => 'required|email',
    ]);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
        ? back()->with('status', __($status))
        : back()->withErrors([
            'email' => __($status),
        ]);

})->name('password.email');


Route::get('/register', function () {
    return view('auth.register');
})->name('register');


Route::post('/register', [AuthController::class, 'register'])
    ->name('register.post');




Route::get('/forgot-password', [PasswordController::class, 'formCorreo'])
    ->name('password.request');

Route::post('/forgot-password', [PasswordController::class, 'enviarCodigo'])
    ->name('password.email');

Route::get('/verificar-codigo', [PasswordController::class, 'formCodigo'])
    ->name('password.codigo');

Route::post('/verificar-codigo', [PasswordController::class, 'verificarCodigo'])
    ->name('password.verificar');

Route::get('/nueva-password', [PasswordController::class, 'formNuevaPassword'])
    ->name('password.nueva');

Route::post('/nueva-password', [PasswordController::class, 'guardarPassword'])
    ->name('password.guardar');


Route::get('/auth/google', [GoogleAuthController::class, 'redirect'])
    ->name('google.login');


Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback']);
/*
|--------------------------------------------------------------------------
| Página principal
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('login');
});



Route::get('/login', function () {
    return view('login');
})->name('login');

/*
|--------------------------------------------------------------------------
| Autenticación
|--------------------------------------------------------------------------
*/

Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth');

/*
|--------------------------------------------------------------------------
| Panel de años
|--------------------------------------------------------------------------
*/

Route::get('/panel', [AnioController::class, 'index'])
    ->middleware('auth')
    ->name('panel');

Route::post('/anios', [AnioController::class, 'store'])
    ->name('anios.store');

Route::get('/panel/{anio}', [AnioController::class, 'show'])
    ->middleware('auth')
    ->name('anios.show');

Route::put('/anios/{id}/activar', [AnioController::class, 'activar'])
    ->name('anios.activar');

Route::delete('/anios/{id}', [AnioController::class, 'destroy'])
    ->name('anios.destroy');
    Route::delete('/anios/{id}/eliminar', [AnioController::class, 'eliminar'])
    ->name('anios.eliminar');

/*
|--------------------------------------------------------------------------
| Estudiantes
|--------------------------------------------------------------------------
*/

Route::resource('estudiantes', EstudianteController::class);

Route::post('/estudiantes', [EstudianteController::class, 'store'])
    ->name('estudiantes.store');

Route::get('/estudiantes/create', [CarreraController::class, 'create']);
Route::resource('estudiantes', EstudianteController::class);

/*
|--------------------------------------------------------------------------
| Exámenes
|--------------------------------------------------------------------------
*/

Route::resource('examenes', ExamenController::class);

Route::get('/examenes-form', [ExamenController::class, 'formulario']);

Route::get('/index', [ExamenController::class, 'index']);
Route::get('/examenes/{id}/edit', [ExamenController::class, 'edit'])
    ->name('examenes.edit');

Route::put('/examenes/{id}', [ExamenController::class, 'update'])
    ->name('examenes.update');
/*
|--------------------------------------------------------------------------
| Reportes
|--------------------------------------------------------------------------
*/

Route::get('/reportes', [ReporteController::class, 'index']);

Route::get('/reportes/{tipo}/{id}', [ReporteController::class, 'tipo_reporte']);

Route::get('/reporte-general', [ReporteController::class, 'test']);

Route::get('/reporte-excel', [ReporteController::class, 'exportarExcel'])
    ->name('reporte.excel');

/*
|--------------------------------------------------------------------------
| Calendario
|--------------------------------------------------------------------------
*/

Route::get('/estudiantes-calendario', [CalendarioController::class, 'index'])
    ->name('calendario.index');

    /*
|--------------------------------------------------------------------------
| Carreras
|--------------------------------------------------------------------------
*/
Route::resource('carreras', CarreraController::class);
  /*
|--------------------------------------------------------------------------
| Correos de prueba
|--------------------------------------------------------------------------
*/


Route::get('/test-mail', function () {

    Mail::raw('Prueba de correo desde el Sistema de Control de Calificaciones TecNM', function ($message) {
        $message->to('c81564222@gmail.com')
                ->subject('Prueba de correo Laravel');
    });

    return 'Correo enviado correctamente';
});



Route::get(
    '/examenes/{id}/enviar',
    [ExamenController::class, 'enviarResultado']
);


Route::post(
    '/estudiantes/{id}/notificar',
    [EstudianteController::class, 'notificar']
)->name('estudiantes.notificar');


Route::get(
    '/estudiantes/{id}/notificar/editar',
    [EstudianteController::class, 'editarNotificacion']
)->name('estudiantes.notificar.editar');

Route::post(
    '/estudiantes/{id}/notificar/enviar',
    [EstudianteController::class, 'enviarNotificacion']
)->name('estudiantes.notificar.enviar');

 /*
|--------------------------------------------------------------------------
| ver comprovante
|--------------------------------------------------------------------------
*/



Route::get('/examenes/{id}/comprobante', [ExamenController::class, 'verComprobante'])
    ->name('examenes.comprobante');

 /*
|--------------------------------------------------------------------------
| Calificaciones
|--------------------------------------------------------------------------
*/
Route::get('/calificaciones', [CalificacionController::class, 'index'])
    ->name('calificaciones.index');

Route::get('/calificaciones/create/{id}', [CalificacionController::class, 'create'])
    ->name('calificaciones.create');

Route::post('/calificaciones', [CalificacionController::class, 'store'])
    ->name('calificaciones.store');

Route::get('/calificaciones/{id}/edit', [CalificacionController::class, 'edit'])
    ->name('calificaciones.edit');

Route::put('/calificaciones/{id}', [CalificacionController::class, 'update'])
    ->name('calificaciones.update');

Route::delete('/calificaciones/{id}', [CalificacionController::class, 'destroy'])
    ->name('calificaciones.destroy');
<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Capturar Calificación</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}


body{

    background:rgb(10,10,10);

    color:rgb(57,255,136);

    font-family:Consolas, monospace;

    display:flex;

    justify-content:center;

    align-items:flex-start;

    min-height:100vh;

    padding-top:50px;

}



form{

    width:450px;

    border:2px solid rgb(57,166,255);

    padding:30px;

    border-radius:10px;

    background:rgb(5,5,5);

    box-shadow:
    0 0 20px rgba(57,166,255,.35);

}



h1{

    text-align:center;

    color:rgb(57,255,136);

    margin-bottom:25px;

}



label{

    display:block;

    margin-bottom:8px;

    color:rgb(57,166,255);

    font-weight:bold;

}



input,
select{


    width:100%;

    padding:12px;

    margin-bottom:20px;

    background:#000;

    border:1px solid rgb(57,166,255);

    border-radius:6px;

    color:rgb(57,255,136);

    font-family:Consolas, monospace;

    outline:none;


}



input:focus,
select:focus{


    border-color:rgb(57,255,136);

    box-shadow:
    0 0 10px rgba(57,255,136,.7);


}



button{


    width:100%;

    padding:14px;

    background:rgb(57,255,136);

    color:#000;

    border:none;

    border-radius:6px;

    font-weight:bold;

    cursor:pointer;

    font-family:Consolas, monospace;

    font-size:16px;

    transition:.3s;


}



button:hover{


    background:rgb(40,220,110);

    box-shadow:
    0 0 12px rgba(57,255,136,.6);


}



.back-btn{


    display:block;

    text-align:center;

    margin-top:20px;

    padding:12px;

    background:rgb(57,166,255);

    color:#000;

    text-decoration:none;

    font-weight:bold;

    border-radius:6px;

    transition:.3s;


}



.back-btn:hover{


    background:rgb(57,255,136);

    box-shadow:
    0 0 12px rgba(57,255,136,.6);


}



.success{


    background:rgb(57,255,136);

    color:#000;

    padding:12px;

    border-radius:6px;

    margin-bottom:20px;

    font-weight:bold;


}



.error{


    background:rgb(255,59,59);

    color:white;

    padding:12px;

    border-radius:6px;

    margin-bottom:20px;

    font-weight:bold;


}


</style>
</head>

<body>

<div class="container">

<form method="POST"
      action="{{ route('calificaciones.store') }}">

    @csrf

    <h1>CAPTURA DE CALIFICACIÓN</h1>

    @if(session('error'))

        <div class="error">

            {{ session('error') }}

        </div>

    @endif

    @if(session('success'))

        <div class="success">

            {{ session('success') }}

        </div>

    @endif

    <input
        type="hidden"
        name="examen_id"
        value="{{ $examen->id }}">
            <label>Alumno</label>

    <input
        type="text"
        value="{{ $examen->estudiante->nombre_completo }}"
        readonly>

    <label>Número de Control</label>

    <input
        type="text"
        value="{{ $examen->estudiante->numero_control }}"
        readonly>

    <label>Tipo de Examen</label>

    <input
        type="text"
        id="tipo_examen"
        value="{{ $examen->tipo_examen }}"
        readonly>

    <label>Fecha</label>

    <input
        type="text"
        value="{{ $examen->fecha }}"
        readonly>

    <hr>

    <!-- ===================== -->
    <!-- EXAMEN DE UBICACIÓN -->
    <!-- ===================== -->

    <div id="ubicacion" style="display:none;">

        <label>Nivel obtenido</label>

        <select name="nivel_ubicacion">

            <option value="">
                Seleccione un nivel
            </option>

            @for($i = 1; $i <= 10; $i++)

                <option value="{{ $i }}">

                    Nivel {{ $i }}

                </option>

            @endfor

        </select>

    </div>

    <!-- ===================== -->
    <!-- 4 HABILIDADES -->
    <!-- ===================== -->

    <div id="habilidades" style="display:none;">

        <label>Reading</label>

        <input
            type="number"
            name="reading"
            step="0.1"
            min="0"
            max="10">

        <label>Listening</label>

        <input
            type="number"
            name="listening"
            step="0.1"
            min="0"
            max="10">

        <label>Writing</label>

        <input
            type="number"
            name="writing"
            step="0.1"
            min="0"
            max="10">

        <label>Speaking</label>

        <input
            type="number"
            name="speaking"
            step="0.1"
            min="0"
            max="10">

    </div>

    <!-- ===================== -->
    <!-- TOEFL -->
    <!-- ===================== -->

    <div id="toefl" style="display:none;">

        <label>Puntaje TOEFL ITP</label>

        <input
        type="number"
        name="toefl">

    </div>

    <!-- ===================== -->
    <!-- SPEAKING CERTIFICACIÓN -->
    <!-- ===================== -->

    <div id="speaking" style="display:none;">

        <label>Calificación Speaking</label>

       <input
        type="number"
        name="speaking_certificacion"
        step="0.1"
        min="0"
        max="100"
        value="{{ old('speaking_certificacion') }}">

    </div>

    <button type="submit">

        GUARDAR CALIFICACIÓN

    </button>

    <a href="{{ route('calificaciones.index') }}"
       class="btn cancelar">

        Retroceder

    </a>
    </form>

</div>

<script>

document.addEventListener('DOMContentLoaded', function () {

    const tipo = document.getElementById('tipo_examen').value;

    const ubicacion   = document.getElementById('ubicacion');
    const habilidades = document.getElementById('habilidades');
    const toefl       = document.getElementById('toefl');
    const speaking    = document.getElementById('speaking');

    /*
    |--------------------------------------------------------------------------
    | Ocultar todos los formularios
    |--------------------------------------------------------------------------
    */

    ubicacion.style.display = "none";
    habilidades.style.display = "none";
    toefl.style.display = "none";
    speaking.style.display = "none";

    /*
    |--------------------------------------------------------------------------
    | Mostrar el correspondiente
    |--------------------------------------------------------------------------
    */

    switch (tipo) {

        case 'Examen de Ubicación':

            ubicacion.style.display = "block";

            break;

        case 'Examen General de 4 Habilidades':

            habilidades.style.display = "block";

            break;

        case 'TOEFL ITP':

            toefl.style.display = "block";

            break;

        case 'Speaking por Certificación':

            speaking.style.display = "block";

            break;

    }

});

</script>

</body>

</html>
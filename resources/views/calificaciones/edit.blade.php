<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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

    padding:40px;

}





.container{

    width:650px;

    margin:auto;

    background:rgb(5,5,5);

    padding:30px;

    border:2px solid rgb(57,166,255);

    border-radius:10px;

    box-shadow:
    0 0 20px rgba(57,166,255,.35);


}





h1{

    text-align:center;

    color:rgb(57,255,136);

    margin-bottom:25px;


}





hr{

    margin:25px 0;

    border:1px solid rgb(57,166,255);


}





label{

    display:block;

    margin-top:15px;

    margin-bottom:5px;

    font-weight:bold;

    color:rgb(57,166,255);


}





input,
select{


    width:100%;

    padding:10px;

    background:#111;

    color:rgb(57,255,136);

    border:1px solid rgb(57,166,255);

    border-radius:6px;

    outline:none;

    font-family:Consolas, monospace;


}





input:focus,
select:focus{


    border-color:rgb(57,255,136);

    box-shadow:
    0 0 10px rgba(57,255,136,.7);


}





button{


    width:100%;

    margin-top:25px;

    padding:12px;

    background:rgb(57,255,136);

    color:#000;

    border:none;

    border-radius:6px;

    cursor:pointer;

    font-size:16px;

    font-weight:bold;

    font-family:Consolas, monospace;

    transition:.3s;


}





button:hover{


    background:rgb(40,220,110);

    box-shadow:
    0 0 12px rgba(57,255,136,.6);


}





.btn{


    display:block;

    text-align:center;

    margin-top:15px;

    padding:12px;

    border-radius:6px;

    text-decoration:none;

    font-weight:bold;


}





.cancelar{


    background:rgb(57,166,255);

    color:#000;


}





.cancelar:hover{


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

    <form method="POST" action="{{ route('calificaciones.update', $calificacion->id) }}">

    @csrf
    @method('PUT')

    <h1>EDITAR CALIFICACIÓN</h1>

    @if(session('error'))
        <p class="error">
            {{ session('error') }}
        </p>
    @endif

    @if(session('success'))
        <p class="success">
            {{ session('success') }}
        </p>
    @endif

    <input type="hidden"
           name="examen_id"
           value="{{ $calificacion->examen->id }}">

    <label>Alumno</label>

    <input type="text"
           value="{{ $calificacion->examen->estudiante->nombre_completo }}"
           readonly>

    <label>Número de Control</label>

    <input type="text"
           value="{{ $calificacion->examen->estudiante->numero_control }}"
           readonly>

    <label>Tipo de Examen</label>

    <input type="text"
           id="tipo_examen"
           value="{{ $calificacion->examen->tipo_examen }}"
           readonly>

    <label>Fecha</label>

    <input type="text"
           value="{{ $calificacion->examen->fecha }}"
           readonly>

    <hr>

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

    <div id="habilidades" style="display:none;">

        <label>Reading</label>

        <input type="number"
               step="0.1"
               name="reading"
               value="{{ $calificacion->reading }}">

        <label>Listening</label>

        <input type="number"
               step="0.1"
               name="listening"
               value="{{ $calificacion->listening }}">

        <label>Writing</label>

        <input type="number"
               step="0.1"
               name="writing"
               value="{{ $calificacion->writing }}">

        <label>Speaking</label>

        <input type="number"
               step="0.1"
               name="speaking"
               value="{{ $calificacion->speaking }}">

    </div>

    <div id="toefl" style="display:none;">

        <label>Puntaje TOEFL ITP</label>

        <input type="number"
               name="toefl"
               value="{{ $calificacion->toefl }}">

    </div>

    <div id="speaking" style="display:none;">

        <label>Speaking</label>

        <input type="number"
               step="0.1"
               name="speaking_certificacion"
               value="{{ $calificacion->speaking_certificacion }}">

    </div>

    <button type="submit">

        ACTUALIZAR CALIFICACIÓN

    </button>

    <a href="{{ route('calificaciones.index') }}"
       class="btn cancelar">

        Retroceder

    </a>

</form>
<script>

const tipo = document.getElementById('tipo_examen').value;

if(tipo === 'Examen de Ubicación')
{
    document.getElementById('ubicacion').style.display = 'block';
}

if(tipo === 'Examen General de 4 Habilidades')
{
    document.getElementById('habilidades').style.display = 'block';
}

if(tipo === 'TOEFL ITP')
{
    document.getElementById('toefl').style.display = 'block';
}

if(tipo === 'Speaking por Certificación')
{
    document.getElementById('speaking').style.display = 'block';
}

</script>

</div>

</body>

</html>
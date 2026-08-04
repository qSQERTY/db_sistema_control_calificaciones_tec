<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<title>Resultado de examen</title>

</head>


<body style="
    font-family:Arial, Helvetica, sans-serif;
    background:#f4f6f9;
    padding:30px;
">


<div style="
    max-width:650px;
    margin:auto;
    background:white;
    padding:30px;
    border-radius:10px;
    box-shadow:0 4px 10px rgba(0,0,0,.15);
">


<h2 style="
    text-align:center;
    color:#2563eb;
">

    Tecnológico Nacional de México

</h2>


<h3 style="
    text-align:center;
    color:#1f2937;
">

    Sistema de Control de Calificaciones

</h3>


<hr>



<h3>
    Información del alumno
</h3>


<p>

<strong>Nombre:</strong>

{{ $estudiante->nombre_completo }}

</p>


<p>

<strong>Número de control:</strong>

{{ $estudiante->numero_control }}

</p>



<p>

<strong>Carrera:</strong>

{{ $estudiante->carrera->nombre ?? 'Sin carrera registrada' }}

</p>



<hr>



<h3>
    Información del examen
</h3>


<p>

<strong>Tipo de examen:</strong>

{{ $examen->tipo_examen }}

</p>


<p>

<strong>Fecha:</strong>

{{ $examen->fecha }}

</p>



<hr>



<h3>
    Resultado
</h3>



@if($calificacion)


@if($calificacion->tipo == 'ubicacion')


<p>

<strong>Nivel obtenido:</strong>

Nivel {{ $calificacion->nivel_ubicacion }}

</p>



@elseif($calificacion->tipo == '4_habilidades')


<p>

<strong>Reading:</strong>

{{ $calificacion->reading }}

</p>


<p>

<strong>Listening:</strong>

{{ $calificacion->listening }}

</p>


<p>

<strong>Writing:</strong>

{{ $calificacion->writing }}

</p>


<p>

<strong>Speaking:</strong>

{{ $calificacion->speaking }}

</p>


<p>

<strong>Promedio:</strong>

{{ $calificacion->promedio }}

</p>



@elseif($calificacion->tipo == 'toefl')


<p>

<strong>Puntaje TOEFL:</strong>

{{ $calificacion->puntaje_toefl }}

</p>



@elseif($calificacion->tipo == 'speaking_certificacion')


<p>

<strong>Speaking:</strong>

{{ $calificacion->calificacion_speaking }}

</p>


@endif



@endif



<hr>



<div style="
    background:#f3f4f6;
    padding:20px;
    border-radius:8px;
    margin-top:20px;
">


<p>

<strong>Mensaje:</strong>

</p>


<p>

{{ $mensaje }}

</p>


</div>




<br>



<p>

Atentamente:

</p>


<p>

<strong>
Sistema de Control de Calificaciones
</strong>

<br>

Tecnológico Nacional de México

</p>



</div>


</body>

</html>
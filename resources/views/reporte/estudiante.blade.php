<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Reporte Individual</title>

<style>

body{

    font-family: Arial, sans-serif;

    color:#222;

    font-size:12px;

}


.header{

    text-align:center;

    border-bottom:2px solid #1f2937;

    padding-bottom:15px;

    margin-bottom:20px;

}


.header h1{

    margin:0;

    font-size:20px;

}


.header h2{

    margin:5px 0;

    font-size:15px;

}



.section{

    margin-bottom:20px;

}


.section-title{

    background:#1f2937;

    color:white;

    padding:8px;

    font-size:14px;

}



table{

    width:100%;

    border-collapse:collapse;

    margin-top:10px;

}



td,th{

    border:1px solid #ccc;

    padding:8px;

}



.label{

    font-weight:bold;

    width:30%;

}



.resultado{

    background:#f3f4f6;

}


</style>

</head>


<body>


<div class="header">

    <h1>
        Tecnológico Nacional de México
    </h1>

    <h2>
        Sistema de Control de Calificaciones
    </h2>


    <p>
        Reporte individual de examen
    </p>

</div>



<div class="section">


<div class="section-title">

    Datos del estudiante

</div>



<table>


<tr>

<td class="label">
Número de control
</td>

<td>
{{ $estudiante->numero_control }}
</td>

</tr>



<tr>

<td class="label">
Nombre completo
</td>

<td>
{{ $estudiante->nombre_completo }}
</td>

</tr>



<tr>

<td class="label">
Carrera
</td>

<td>
{{ $estudiante->carrera->nombre ?? 'Sin carrera' }}
</td>

</tr>



<tr>

<td class="label">
Correo
</td>

<td>
{{ $estudiante->correo }}
</td>

</tr>



<tr>

<td class="label">
Horario
</td>

<td>
{{ $estudiante->horario }}
</td>

</tr>



<tr>

<td class="label">
Tipo de alumno
</td>

<td>
{{ $estudiante->tipo_alumno }}
</td>

</tr>


</table>


</div>





@foreach($estudiante->examenes as $examen)


<div class="section">


<div class="section-title">

    Información del examen

</div>



<table>


<tr>

<td class="label">
Tipo de examen
</td>

<td>
{{ $examen->tipo_examen }}
</td>

</tr>


<tr>

<td class="label">
Fecha
</td>

<td>
{{ $examen->fecha }}
</td>

</tr>



<tr>

<td class="label">
Intento
</td>

<td>
{{ $examen->intento }}
</td>

</tr>



<tr>

<td class="label">
Folio
</td>

<td>
{{ $examen->folio }}
</td>

</tr>



<tr>

<td class="label">
Pago
</td>

<td>
{{ $examen->pago ? 'Pagado' : 'Pendiente' }}
</td>

</tr>



</table>



</div>





<div class="section">


<div class="section-title">

    Resultados

</div>


<table>


@if($examen->resultadoCalificacion)



@if($examen->tipo_examen == 'Examen General de 4 Habilidades')


<tr>
<td class="label">Reading</td>
<td>{{ $examen->resultadoCalificacion->reading }}</td>
</tr>


<tr>
<td class="label">Listening</td>
<td>{{ $examen->resultadoCalificacion->listening }}</td>
</tr>


<tr>
<td class="label">Writing</td>
<td>{{ $examen->resultadoCalificacion->writing }}</td>
</tr>


<tr>
<td class="label">Speaking</td>
<td>{{ $examen->resultadoCalificacion->speaking }}</td>
</tr>


<tr>
<td class="label">Promedio</td>
<td>{{ $examen->resultadoCalificacion->promedio }}</td>
</tr>


@elseif($examen->tipo_examen == 'Examen de Ubicación')


<tr>

<td class="label">
Nivel obtenido
</td>

<td>
{{ $examen->resultadoCalificacion->nivel_ubicacion }}
</td>

</tr>


@elseif($examen->tipo_examen == 'TOEFL ITP')


<tr>

<td class="label">
Puntaje TOEFL
</td>

<td>
{{ $examen->resultadoCalificacion->puntaje_toefl }}
</td>

</tr>


@elseif($examen->tipo_examen == 'Speaking por Certificación')


<tr>

<td class="label">
Speaking
</td>

<td>
{{ $examen->resultadoCalificacion->calificacion_speaking }}
</td>

</tr>


@endif



@else


<tr>

<td colspan="2">

Sin calificación registrada

</td>

</tr>


@endif


</table>


</div>


@endforeach



</body>

</html>
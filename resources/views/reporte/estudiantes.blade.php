<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Reporte General</title>


<style>

body{

    font-family: Arial, Helvetica, sans-serif;

    font-size:11px;

    color:#222;

}


.header{

    text-align:center;

    margin-bottom:20px;

    border-bottom:3px solid #1f2937;

    padding-bottom:15px;

}


.header h1{

    margin:0;

    font-size:22px;

    color:#111827;

}


.header h2{

    margin:5px 0;

    font-size:16px;

    color:#374151;

}


.header p{

    margin:3px;

    font-size:12px;

}



.info{

    width:100%;

    margin-bottom:15px;

}



.info td{

    border:none;

    padding:5px;

}



table{

    width:100%;

    border-collapse:collapse;

}



thead{

    display:table-header-group;

}



th{

    background:#1f2937;

    color:white;

    padding:8px;

    border:1px solid #111827;

}



td{

    padding:7px;

    border:1px solid #d1d5db;

    text-align:center;

}



tr:nth-child(even){

    background:#f9fafb;

}



.footer{

    position:fixed;

    bottom:-20px;

    width:100%;

    text-align:center;

    font-size:10px;

    color:#6b7280;

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
Reporte general de exámenes
</p>

<p>
Fecha de generación:
{{ date('d/m/Y') }}
</p>

</div>
<table class="info">

<tr>

<td>
<strong>Total de registros:</strong>

{{ $estudiantes->sum(function($e){

    return $e->examenes->count();

}) }}

</td>


</tr>

</table>




<table>


<thead>

<tr>

<th>
No. Control
</th>


<th>
Nombre
</th>


<th>
Carrera
</th>


<th>
Tipo de examen
</th>


<th>
Fecha
</th>


</tr>


</thead>



<tbody>



@foreach($estudiantes as $estudiante)


    @foreach($estudiante->examenes as $examen)


    <tr>


        <td>
        {{ $estudiante->numero_control }}
        </td>


        <td>
        {{ $estudiante->nombre_completo }}
        </td>


        <td>
        {{ $estudiante->carrera->nombre ?? 'Sin carrera' }}
        </td>


        <td>
        {{ $examen->tipo_examen }}
        </td>


        <td>
        {{ $examen->fecha }}
        </td>


    </tr>


    @endforeach


@endforeach



</tbody>


</table>
<div class="footer">

Sistema de Control de Calificaciones -
Tecnológico Nacional de México

</div>



</body>

</html>
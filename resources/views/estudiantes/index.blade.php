<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Estudiantes</title>

<style>


body{

    background:rgb(10,10,10);

    color:rgb(57,255,136);

    font-family:Consolas, monospace;

    margin:40px;

}





h1{

    text-align:center;

    margin-bottom:25px;

    color:rgb(57,255,136);

}





.top{

    display:flex;

    justify-content:space-between;

    align-items:center;

    margin-bottom:20px;

}





input[type=text]{


    padding:10px;

    width:300px;

    background:#000;

    color:rgb(57,255,136);

    border:1px solid rgb(57,166,255);

    border-radius:6px;

    outline:none;

}





input[type=text]:focus{


    border-color:rgb(57,255,136);

    box-shadow:
    0 0 8px rgba(57,255,136,.6);


}





button{


    background:rgb(57,255,136);

    color:#000;

    border:none;

    padding:10px 18px;

    cursor:pointer;

    font-weight:bold;

    border-radius:5px;


}





button:hover{


    background:rgb(40,220,110);


}





.btn{


    padding:8px 15px;

    text-decoration:none;

    border-radius:5px;

    font-weight:bold;


}





.nuevo{


    background:rgb(57,255,136);

    color:#000;


}





.editar{


    background:rgb(57,166,255);

    color:#000;


}





.eliminar{


    background:rgb(255,59,59);

    color:white;


}





table{


    width:100%;

    border-collapse:collapse;

    background:rgb(5,5,5);

    box-shadow:
    0 0 20px rgba(57,166,255,.25);


}





table th,
table td{


    border:1px solid rgb(57,166,255);

    padding:12px;

    text-align:center;


}





table th{


    background:#111;

    color:rgb(57,255,136);


}





tr:nth-child(even){


    background:#111;


}





tr:hover{


    background:rgba(57,255,136,.12);


}





.alert{


    background:rgb(57,255,136);

    color:#000;

    padding:15px;

    margin-bottom:20px;

    border-radius:5px;

    font-weight:bold;


}





.acciones{


    display:flex;

    justify-content:center;

    gap:10px;


}





.back-btn{


    display:inline-block;

    margin-bottom:20px;

    padding:12px 20px;

    background:rgb(57,166,255);

    color:#000;

    text-decoration:none;

    font-weight:bold;

    border-radius:5px;


}





.back-btn:hover{


    background:rgb(57,255,136);


}



</style>

</head>
<body>

<h1>ESTUDIANTES</h1>

@if(session('success'))
<div class="alert">
    {{ session('success') }}
</div>
@endif

<div class="top">

<form method="GET" action="{{ route('estudiantes.index') }}">

    <input
        type="text"
        name="buscar"
        placeholder="Buscar por nombre o No. de control..."
        value="{{ request('buscar') }}">

    <button type="submit">
        Buscar
    </button>

</form>

<a href="{{ route('estudiantes.create') }}" class="btn nuevo">
    + Nuevo Estudiante
</a>

<a href="{{ route('panel') }}" class="back-btn">
    Volver al Menú Principal
</a>

</div>

<table>

<thead>

<tr>

    <th>No. Control</th>
    <th>Nombre</th>
    <th>Correo</th>
    <th>Carrera</th>
    <th>Horario</th>
    <th>Tipo</th>
    <th>Acciones</th>

</tr>

</thead>

<tbody>

@forelse($estudiantes as $estudiante)

<tr>

<td>{{ $estudiante->numero_control }}</td>

<td>{{ $estudiante->nombre_completo }}</td>

<td>{{ $estudiante->correo }}</td>

<td>{{ $estudiante->carrera->nombre ?? 'Sin carrera' }}</td>

<td>{{ $estudiante->horario }}</td>

<td>{{ $estudiante->tipo_alumno }}</td>

<td>

<div class="acciones">

<a
href="{{ route('estudiantes.edit',$estudiante->id) }}"
class="btn editar">
Editar
</a>

<form
action="{{ route('estudiantes.destroy',$estudiante->id) }}"
method="POST"
onsubmit="return confirm('¿Eliminar estudiante?');">

@csrf
@method('DELETE')

<button class="btn eliminar">
Eliminar
</button>

</form>

</div>

</td>

</tr>

@empty

<tr>

<td colspan="7">
No hay estudiantes registrados.
</td>

</tr>

@endforelse

</tbody>

</table>

@if(method_exists($estudiantes,'links'))
<div style="margin-top:20px;">
    {{ $estudiantes->links() }}
</div>
@endif

</body>
</html>     
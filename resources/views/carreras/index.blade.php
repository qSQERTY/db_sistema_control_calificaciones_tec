<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Carreras</title>

<style>


body{

    background:rgb(10,10,10);

    color:rgb(57,255,136);

    font-family:Consolas, monospace;

    display:flex;

    justify-content:center;

    align-items:center;

    min-height:100vh;

}




.container{

    width:80%;

}





h1{

    text-align:left;

    margin-bottom:25px;

    color:rgb(57,255,136);

}





table{

    width:100%;

    border-collapse:collapse;

    background:rgb(5,5,5);

    border:2px solid rgb(57,166,255);

    box-shadow:
    0 0 20px rgba(57,166,255,.25);

}





th{

    padding:15px;

    border-bottom:2px solid rgb(57,166,255);

    color:rgb(57,255,136);

    text-align:left;

}





td{

    padding:15px;

    text-align:left;

    border-bottom:1px solid rgb(57,166,255);

}





th:first-child,
td:first-child{

    width:10%;

    text-align:center;

}





th:nth-child(2),
td:nth-child(2){

    width:70%;

    text-align:left;

}





th:last-child,
td:last-child{

    width:20%;

    text-align:center;

}





tr:hover{

    background:rgba(57,255,136,.12);

}





.dropdown{

    position:relative;

    display:inline-block;

}





.dropbtn{

    background:rgb(57,255,136);

    color:#000;

    padding:10px 15px;

    border:none;

    font-weight:bold;

    cursor:pointer;

    font-family:Consolas, monospace;

    border-radius:6px;

}





.dropdown-content{

    display:none;

    position:absolute;

    background:rgb(5,5,5);

    border:1px solid rgb(57,166,255);

    min-width:150px;

    box-shadow:
    0 0 15px rgba(57,166,255,.3);

    z-index:1;

}





.dropdown-content a{

    color:rgb(57,255,136);

    padding:10px;

    display:block;

    text-decoration:none;

}





.dropdown-content a:hover{

    background:rgb(57,255,136);

    color:#000;

}





.dropdown:hover .dropdown-content{

    display:block;

}





.dropdown-content form{

    width:100%;

    border:none;

    padding:0;

    background:none;

}





.delete-btn{

    width:100%;

    padding:10px;

    background:rgb(255,59,59);

    color:white;

    border:none;

    cursor:pointer;

    font-family:Consolas, monospace;

}





.delete-btn:hover{

    background:rgb(220,40,40);

}





.add-btn{

    display:inline-block;

    margin-bottom:20px;

    padding:12px 20px;

    background:rgb(57,255,136);

    color:#000;

    text-decoration:none;

    font-weight:bold;

    border-radius:5px;

}





.add-btn:hover{

    background:rgb(40,220,110);

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


<div class="container">


<h1>
    Lista de Carreras
</h1>


<a href="{{ route('carreras.create') }}" class="add-btn">
    Nueva Carrera
</a>

<a href="{{ route('panel') }}" class="back-btn">
    Volver al Menú Principal
</a>



<table>


<thead>

<tr>

    <th>
        ID
    </th>


    <th>
        Nombre Carrera
    </th>


    <th>
        Acciones
    </th>

</tr>

</thead>



<tbody>


@foreach($carreras as $carrera)


<tr>


<td>
    {{ $carrera->id }}
</td>


<td>
    {{ $carrera->nombre }}
</td>


<td>


<div class="dropdown">


<button class="dropbtn">
    Opciones
</button>


<div class="dropdown-content">


<a href="/carreras/{{ $carrera->id }}">
    Ver
</a>



<a href="/carreras/{{ $carrera->id }}/edit">
    Editar
</a>



<form action="/carreras/{{ $carrera->id }}" method="POST">

    @csrf
    @method('DELETE')


    <button type="submit" class="delete-btn">
        Eliminar
    </button>


</form>



</div>


</div>


</td>


</tr>


@endforeach


</tbody>


</table>


</div>


</body>

</html>
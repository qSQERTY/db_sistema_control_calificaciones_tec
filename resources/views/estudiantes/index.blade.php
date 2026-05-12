<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Estudiantes</title>

<style>

body{
    background:#0a0a0a;
    color:#39ff88;
    font-family:Consolas, monospace;
    padding:40px;
}

h1{
    margin-bottom:30px;
}

a{
    text-decoration:none;
}

.btn{
    background:#39ff88;
    color:#000;
    padding:12px 20px;
    border-radius:8px;
    font-weight:bold;
}

table{
    width:100%;
    border-collapse:collapse;
    margin-top:30px;
}

table th,
table td{
    border:1px solid #39ff88;
    padding:15px;
    text-align:center;
}

table th{
    background:#050505;
}

tr:hover{
    background:rgba(57,255,136,.08);
}
.dropdown{
    position:relative;
}

.dropbtn{
    background:#39ff88;
    color:#000;
    border:none;
    padding:10px 15px;
    cursor:pointer;
    font-weight:bold;
    border-radius:6px;
}

.dropdown-content{
    display:none;
    position:absolute;
    background:#050505;
    min-width:150px;
    border:1px solid #39ff88;
    z-index:10;
}

.dropdown-content a,
.dropdown-content button{
    color:#39ff88;
    padding:12px;
    text-decoration:none;
    display:block;
    background:none;
    border:none;
    width:100%;
    text-align:left;
    cursor:pointer;
    font-family:Consolas, monospace;
}

.dropdown-content a:hover,
.dropdown-content button:hover{
    background:#39ff88;
    color:#000;
}

.dropdown:hover .dropdown-content{
    display:block;
}

.delete-btn{
    font-size:15px;
}

</style>

</head>
<body>

<h1>ESTUDIANTES</h1>

<a href="/estudiantes/create" class="btn">
    + Nuevo Estudiante
</a>

<table>

    <thead>
        <tr>
            <th>No Control</th>
            <th>Nombre Completo</th>
            <th>Carrera</th>
            <th>Horario</th>
            <th>Tipo Alumno</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>

        @foreach($estudiantes as $estudiante)

        <tr>
            <td>{{ $estudiante->numero_control }}</td>
            <td>{{ $estudiante->nombre_completo }}</td>
            <td>{{ $estudiante->carrera }}</td>
            <td>{{ $estudiante->horario }}</td>
            <td>{{ $estudiante->tipo_alumno }}</td> 

            <td>
    <div class="dropdown">
        <button class="dropbtn">
            Opciones
        </button>
        <div class="dropdown-content">
            <a href="/estudiantes/{{ $estudiante->id }}">
                Ver
            </a>
            <a href="/estudiantes/{{ $estudiante->id }}/edit">
                Editar
            </a>
            <form action="/estudiantes/{{ $estudiante->id }}" method="POST">
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

</body>
</html>
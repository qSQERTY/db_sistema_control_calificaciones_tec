<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Estudiante</title>
<style>


body{

    background:rgb(10,10,10);

    color:rgb(57,255,136);

    font-family:Consolas, monospace;

    padding:40px;

}





h1{

    margin-bottom:30px;

    color:rgb(57,255,136);

}





a{

    text-decoration:none;

}





.btn{


    background:rgb(57,255,136);

    color:#000;

    padding:12px 20px;

    border-radius:8px;

    font-weight:bold;

}





.btn:hover{


    background:rgb(40,220,110);


}





table{


    width:100%;

    border-collapse:collapse;

    margin-top:30px;

    background:rgb(5,5,5);

    box-shadow:
    0 0 20px rgba(57,166,255,.25);


}





table th,
table td{


    border:1px solid rgb(57,166,255);

    padding:15px;

    text-align:center;


}





table th{


    background:rgb(5,5,5);

    color:rgb(57,255,136);


}





tr:hover{


    background:rgba(57,255,136,.12);


}





.dropdown{


    position:relative;


}





.dropbtn{


    background:rgb(57,166,255);

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

    background:rgb(5,5,5);

    min-width:150px;

    border:1px solid rgb(57,166,255);

    box-shadow:
    0 0 15px rgba(57,166,255,.35);

    z-index:10;


}





.dropdown-content a,
.dropdown-content button{


    color:rgb(57,255,136);

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


    background:rgb(57,255,136);

    color:#000;


}





.dropdown:hover .dropdown-content{


    display:block;


}





.delete-btn{


    font-size:15px;

    color:rgb(255,59,59) !important;


}





.delete-btn:hover{


    background:rgb(255,59,59) !important;

    color:white !important;


}



</style>

    
</head>
<body>

<h2>Información del Estudiante</h2>

<table>
    <thead>
        <tr>
            <th>No Control</th>
            <th>Nombre Completo</th>
            <th>Carrera</th>
            <th>Horario</th>
            <th>Tipo Alumno</th>
            <th>Fecha de Registro</th>
            <th>Última Actualización</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
        <tr>
            <td>{{ $estudiante->numero_control }}</td>
            <td>{{ $estudiante->nombre_completo }}</td>
           <td>{{ $estudiante->carrera->nombre }}</td>
            <td>{{ $estudiante->horario }}</td>
            <td>{{ $estudiante->tipo_alumno }}</td>
            <td>{{ $estudiante->created_at }}</td>
            <td>{{ $estudiante->updated_at }}</td>

            <td>
                <div class="dropdown">
                    <button class="dropbtn">
                        Opciones
                    </button>

                    <div class="dropdown-content">
                        <a href="/estudiantes">
                            Volver
                        </a>

                        <a href="/estudiantes/{{ $estudiante->id }}/edit">
                            Editar
                        </a>

                        <form action="/estudiantes/{{ $estudiante->id }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="delete-btn"
                                onclick="return confirm('¿Deseas eliminar este estudiante?')">
                                Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            </td>

        </tr>
    </tbody>

</table>

</body>
</html>
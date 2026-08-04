<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Calificaciones</title>


<style>


body{

    background:rgb(10,10,10);

    color:rgb(57,255,136);

    font-family:Consolas, monospace;

    padding:40px;

}





.container{

    width:95%;

    margin:auto;

    background:rgb(5,5,5);

    padding:30px;

    border:2px solid rgb(57,166,255);

    border-radius:10px;

    box-shadow:
    0 0 20px rgba(57,166,255,.35);


}





h1{

    margin-bottom:30px;

    color:rgb(57,255,136);

    text-align:center;


}





h2{

    margin-top:35px;

    color:rgb(57,166,255);


}





table{

    width:100%;

    border-collapse:collapse;

    margin-top:30px;


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





.btn{

    background:rgb(57,255,136);

    color:#000;

    padding:12px 20px;

    border-radius:8px;

    font-weight:bold;


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

    transition:.3s;


}





.back-btn:hover{

    background:rgb(57,255,136);

}





.add-btn{

    display:inline-block;

    padding:12px 20px;

    background:rgb(57,255,136);

    color:#000;

    text-decoration:none;

    font-weight:bold;

    border-radius:5px;

    transition:.3s;


}





.add-btn:hover{

    background:rgb(57,166,255);


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





.dropdown{

    position:relative;

    display:inline-block;


}





.dropdown-content{

    display:none;

    position:absolute;

    background:#050505;

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

    color:rgb(255,59,59) !important;

    font-size:15px;


}





.success{

    background:rgb(57,255,136);

    color:#000;

    padding:12px;

    border-radius:6px;

    margin-bottom:20px;

    font-weight:bold;


}





.empty{

    text-align:center;

    padding:20px;

    color:rgb(57,166,255);


}





.detalle{

    text-align:left;


}





.detalle p{

    margin:5px 0;


}



</style>


</head>


<body>


<div class="container">
    @if(session('success'))

    <div class="success">

        {{ session('success') }}

    </div>

@endif



<h1>

    CALIFICACIONES

</h1>



<a href="/panel" class="back-btn">

    Regresar al Panel

</a>




<h2>

    Exámenes Pendientes

</h2>




<table>


<thead>

<tr>

    <th>ID</th>

    <th>Alumno</th>

    <th>Tipo de Examen</th>

    <th>Fecha</th>

    <th>Acción</th>

</tr>

</thead>



<tbody>


@forelse($examenesPendientes as $examen)


<tr>


    <td>

        {{ $examen->id }}

    </td>



    <td>

        {{ $examen->estudiante->nombre_completo }}

    </td>



    <td>

        {{ $examen->tipo_examen }}

    </td>



    <td>

        {{ $examen->fecha }}

    </td>
    



    <td>


        <a href="{{ route('calificaciones.create', $examen->id) }}"
           class="add-btn">

            Capturar

        </a>


    </td>



</tr>


@empty


<tr>

    <td colspan="5" class="empty">

        No hay exámenes pendientes.

    </td>

</tr>


@endforelse


</tbody>


</table>
<h2>

    Calificaciones Registradas

</h2>



<table>


<thead>

<tr>

    <th>Alumno</th>

    <th>Tipo de Examen</th>

    <th>Resultado</th>

    <th>Acciones</th>

</tr>

</thead>



<tbody>

@forelse($calificaciones as $calificacion)

<tr>

    <td>
        {{ $calificacion->examen->estudiante->nombre_completo }}
    </td>


    <td>
        {{ $calificacion->examen->tipo_examen }}
    </td>


    <td class="detalle">

        @switch($calificacion->examen->tipo_examen)


            @case('Examen de Ubicación')

                <p>
                    <strong>Nivel:</strong>
                    {{ $calificacion->nivel_ubicacion }}
                </p>

            @break



            @case('Examen General de 4 Habilidades')

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
                    {{ number_format($calificacion->promedio,2) }}
                </p>

            @break



            @case('TOEFL ITP')

                <p>
                    <strong>Puntaje TOEFL:</strong>
                    {{ $calificacion->toefl }}
                </p>

            @break



            @case('Speaking por Certificación')

                <p>
                    <strong>Speaking:</strong>
                    {{ $calificacion->speaking_certificacion }}
                </p>

            @break


        @endswitch


        <p>
            <strong>Resultado:</strong>
            {{ $calificacion->examen->resultado }}
        </p>

    </td>



    <td>

        <div class="dropdown">

            <button class="dropbtn">

                Opciones

            </button>


            <div class="dropdown-content">


                <a href="{{ route('calificaciones.edit',$calificacion->id) }}">

                    Editar

                </a>



                <form action="{{ route('calificaciones.destroy',$calificacion->id) }}"
                      method="POST">

                    @csrf

                    @method('DELETE')


                    <button type="submit"
                            class="delete-btn"
                            onclick="return confirm('¿Eliminar esta calificación?')">

                        Eliminar

                    </button>


                </form>


            </div>

        </div>

    </td>


</tr>


@empty


<tr>

    <td colspan="4" class="empty">

        No hay calificaciones registradas.

    </td>

</tr>


@endforelse


</tbody>


</table>
</div>


</body>


</html>
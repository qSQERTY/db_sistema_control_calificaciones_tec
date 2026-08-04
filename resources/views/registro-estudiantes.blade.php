<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Estudiantes</title>

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.18/index.global.min.js"></script>

<style>
    *{
        margin:0;
        padding:0;
        box-sizing:border-box;
        font-family:'Consolas', monospace;
    }

    body{
        background:#0a0a0a;
        color:#fff;
        overflow:hidden;
    }

    header{
        width:100%;
        height:80px;
        background:#050505;
        border-bottom:2px solid #39ff88;
        display:flex;
        justify-content:space-between;
        align-items:center;
        padding:0 25px;
    }

    .logo{
        display:flex;
        align-items:center;
        gap:15px;
    }
.logo-icon{
    width:80px;
    height:80px;
    border:2px solid #39ff88;
    border-radius:10px;
    display:flex;
    justify-content:center;
    align-items:center;
    overflow:hidden;
    flex-shrink:0;
    margin:auto;
}


.logo-img{
    width:100%;
    height:100%;
    object-fit:contain;
    display:block;
    transform:translate(5px,0) scale(2.5);
    transform-origin:center center;
}

    .logo-text h2{
        font-size:18px;
        color:#fff;
    }

    .logo-text p{
        color:#39ff88;
        font-size:13px;
    }

    .search{
        width:45%;
        display:flex;
        background:#101010;
        border:2px solid #39ff88;
        border-radius:50px;
        overflow:hidden;
    }

    .search input{
        flex:1;
        height:48px;
        background:none;
        border:none;
        outline:none;
        color:white;
        padding:0 15px;
        font-size:15px;
    }

    .search button{
        width:110px;
        border:none;
        background:#39ff88;
        color:#000;
        font-weight:bold;
        cursor:pointer;
        transition:.3s;
    }

    .search button:hover{
        background:#20d96b;
    }

    .options select{
        width:140px;
        height:45px;
        background:#111;
        color:white;
        border:2px solid #39ff88;
        border-radius:10px;
        padding-left:10px;
        outline:none;
    }

    .container{
        width:100%;
        height:calc(100vh - 80px);
        display:flex;
    }

    .left{
        width:60%;
        padding:20px;
    }

    .right{
        width:40%;
        padding:20px 20px 20px 0;
    }

    .panel,
    .sidebar{
        width:100%;
        height:100%;
        background:#111;
        border-radius:15px;
        border:1px solid rgba(57,255,136,.2);
        box-shadow:0 0 20px rgba(57,255,136,.08);
    }

    .panel{
        padding:20px;
    }

    .sidebar{
        display:flex;
        flex-direction:column;
    }

    #calendar{
        height:100%;
    }

    .sidebar-header{
        padding:20px;
        border-bottom:1px solid rgba(57,255,136,.2);
    }

    .sidebar-header h2{
        color:#39ff88;
        margin-bottom:5px;
    }

    .stats{
        display:flex;
        justify-content:space-around;
        padding:15px;
        border-bottom:1px solid rgba(57,255,136,.2);
    }

    .stat{
        text-align:center;
    }

    .stat h3{
        color:#39ff88;
        font-size:24px;
    }

    #registros{
        flex:1;
        overflow:auto;
        padding:20px;
    }

    .card{
        background:#181818;
        border-left:5px solid #39ff88;
        padding:15px;
        border-radius:10px;
        margin-bottom:15px;
    }

    .card h3{
        color:#39ff88;
        margin-bottom:5px;
    }

    .card p{
        color:#ccc;
        margin:4px 0;
    }

    .fc{
        color:white;
    }

    .fc-toolbar-title{
        color:#39ff88;
    }

    .fc-button{
        background:#39ff88 !important;
        color:black !important;
        border:none !important;
    }

    .fc-daygrid-event{
        background:#39ff88 !important;
        color:black !important;
        border:none !important;
    }

    .search-date{
        width:300px;
        display:flex;
        background:#101010;
        border:2px solid #39ff88;
        border-radius:50px;
        overflow:hidden;
        margin-top:15px;
    }

    .search-date input{
        flex:1;
        height:48px;
        background:none;
        border:none;
        outline:none;
        color:white;
        padding:0 15px;
        font-size:15px;
    }

    .search-date input::-webkit-calendar-picker-indicator{
        filter:invert(1);
        cursor:pointer;
    }

    .search-date button{
        width:150px;
        border:none;
        background:#39ff88;
        color:#000;
        font-weight:bold;
        cursor:pointer;
        transition:.3s;
    }

    .search-date button:hover{
        background:#20d96b;
    }
</style>
</head>

<body>
    <header>

   <div class="logo">
    <div class="logo-icon">
        <img src="{{ asset('images/logo/3.png') }}" alt="Logo" class="logo-img">
    </div>
</div>
        <div class="logo-text">
            <h2>REGISTRO DE ESTUDIANTES</h2>
            <p>Panel de seguimiento de exámenes</p>
        </div>
    </div>

    <div class="search">
        <input
            type="text"
            id="buscarAlumno"
            placeholder="Buscar estudiante..."
        >
        <button type="button">
            Buscar
        </button>
    </div>

    <div class="search-date">

    <input
        type="date"
        id="buscarFecha">

    <button
        type="button"
        id="irFecha">

        Buscar fecha

    </button>

</div>

    <div class="options">

        <select onchange="location=this.value">

            @foreach($anios as $a)
                <option
                    value="{{ route('anios.show',$a->id) }}"
                    {{ $a->id == $anio->id ? 'selected' : '' }}>
                    {{ $a->anio }}
                </option>
            @endforeach

        </select>

    </div>

</header>

<div class="container">

    <div class="left">

        <div class="panel">

            <div id="calendar"></div>

        </div>

    </div>

    <div class="right">

        <div class="sidebar">

            <div class="sidebar-header">

                <h2 id="fechaSeleccionada">
                    Selecciona un día
                </h2>

                <p>
                    Haz clic en cualquier fecha del calendario.
                </p>

            </div>

            <div class="stats">

                <div class="stat">

                    <h3 id="totalRegistros">0</h3>

                    <span>Registros</span>

                </div>

                <div class="stat">

                    <h3>{{ $anio->anio }}</h3>

                    <span>Año</span>

                </div>

            </div>

            <div id="registros">

                <div class="card">

                    <h3>Sin registros</h3>

                    <p>
                        Selecciona un día del calendario para visualizar los estudiantes registrados.
                    </p>

                </div>

            </div>

        </div>

    </div>

</div>
@php
$registros = $anio->examenes
->groupBy(function ($e) {
    return \Carbon\Carbon::parse($e->fecha)->format('Y-m-d');
})
->map(function ($items) {

    return $items->map(function ($e) {

        $calificacion = $e->resultadoCalificacion;

        return [

            'id' => optional($e->estudiante)->id,

            'nombre' => optional($e->estudiante)->nombre_completo,

            'numero_control' => optional($e->estudiante)->numero_control,

            'correo' => optional($e->estudiante)->correo,

            'horario' => optional($e->estudiante)->horario,

            'tipo' => $e->tipo_examen,

            'resultado' => $e->resultado,

            'datos_calificacion' => match ($e->tipo_examen) {


                'Examen de Ubicación' => [

                    'Nivel obtenido' => 
                    $calificacion?->nivel_ubicacion

                ],


                'Examen General de 4 Habilidades' => [

                    'Reading' =>
                    $calificacion?->reading,

                    'Listening' =>
                    $calificacion?->listening,

                    'Writing' =>
                    $calificacion?->writing,

                    'Speaking' =>
                    $calificacion?->speaking,

                    'Promedio' =>
                    $calificacion?->promedio

                ],


                'TOEFL ITP' => [

    'Puntaje TOEFL' => $calificacion?->toefl

],


                'Speaking por Certificación' => [

    'Speaking' => $calificacion?->speaking_certificacion

    ],

                default => []

            }

        ];

    })->values();

});
@endphp




<script>
    


document.addEventListener('DOMContentLoaded', function () {


    const calendarEl = document.getElementById('calendar');

    const fechaSeleccionada = document.getElementById('fechaSeleccionada');

    const registrosContainer = document.getElementById('registros');

    const totalRegistros = document.getElementById('totalRegistros');

    const buscarAlumno = document.getElementById('buscarAlumno');



    const registros = @json($registros);



    const eventos = [];



    Object.keys(registros).forEach(function(fecha){


        eventos.push({

            title: registros[fecha].length + ' registro(s)',

            start: fecha,

            allDay: true

        });


    });





   const calendar = new FullCalendar.Calendar(calendarEl, {
    

    initialView: 'dayGridMonth',

    initialDate: "{{ $fechaInicial ?? $anio->anio . '-01-01' }}",

    locale: 'es',

    height: '100%',

    events: eventos,

    dateClick: function(info){

        mostrarRegistros(info.dateStr);

    }

});



    calendar.render();
    document.getElementById('irFecha').addEventListener('click', function () {

    const fecha = document.getElementById('buscarFecha').value;

    if (!fecha) {
        alert('Selecciona una fecha.');
        return;
    }

    calendar.gotoDate(fecha);

    mostrarRegistros(fecha);

});





    function mostrarRegistros(fecha){


        fechaSeleccionada.textContent = "Registros del " + fecha;



        registrosContainer.innerHTML = "";



        const datos = registros[fecha] || [];



        totalRegistros.textContent = datos.length;





        if(datos.length===0){


            registrosContainer.innerHTML=`

                <div class="card">

                    <h3>
                        Sin registros
                    </h3>


                    <p>
                        No existen registros para esta fecha.
                    </p>


                </div>

            `;


            return;


        }
        





        datos.forEach(function(est){



            registrosContainer.innerHTML += `

                <div class="card">


                    <h3>
                        ${est.nombre ?? 'Sin nombre'}
                    </h3>

                    <p>

                    <strong>No. Control:</strong>

                        ${est.numero_control ?? '-'}

                    </p>



                    <p>
                        <strong>Correo:</strong> 
                        ${est.correo ?? '-'}
                    </p>



                    <p>
                        <strong>Horario:</strong> 
                        ${est.horario ?? '-'}
                    </p>



                    <p>
                        <strong>Tipo:</strong> 
                        ${est.tipo}
                    </p>



                    <p>
                    <strong>Resultado:</strong> 
                        ${est.resultado ?? 'Sin resultado'}
                    </p>

                <hr>

                    <strong>Calificaciones:</strong>

            <div>
                ${
                Object.entries(est.datos_calificacion ?? {})
                .map(([nombre, valor]) => {

            return `
                <p>
                    <strong>${nombre}:</strong>
                    ${valor ?? 'Sin registrar'}
                </p>
            `;

                })
            .join('')
            }
            </div>




                    <form action="/estudiantes/${est.id}/notificar" method="POST">

                        <input 
                            type="hidden" 
                            name="_token" 
                            value="{{ csrf_token() }}"
                        >


                        <button type="submit" class="btn-notificar">

                            📧 Enviar notificación

                        </button>

                        <a href="/estudiantes/${est.id}/notificar/editar" 
                        class="btn-editar">

                        📧 Editar notificación

                        </a>

                        <a href="{{ route('panel') }}" class="back-btn">
                        Retroceder
                        </a>


                    </form>


                </div>

            `;



        });



    }







    buscarAlumno.addEventListener('keyup',function(){



        const texto=this.value.toLowerCase();



        const cards=document.querySelectorAll('#registros .card');



        cards.forEach(function(card){



            card.style.display =

                card.innerText.toLowerCase().includes(texto)

                ? ''

                : 'none';



        });



    });



});



</script>


<style>

.btn-notificar{

    margin-top:15px;

    background:#39ff88;

    color:#000;

    border:none;

    padding:10px 15px;

    border-radius:8px;

    cursor:pointer;

    font-weight:bold;

}


.btn-notificar:hover{

    background:#20d96b;

}
.btn-editar{

    margin-top:15px;

    background:#39ff88;

    color:#000;

    border:none;

    padding:10px 15px;

    border-radius:8px;

    cursor:pointer;

    

}


.btn-editar:hover{

    background:#20d96b;

}


</style>



</body>
</html>
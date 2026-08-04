<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard</title>

<style>

body{
    margin:0;
    background:#0a0a0a;
    color:#39ff88;
    font-family:Consolas, monospace;
}

.sidebar{
    width:250px;
    height:100vh;
    background:#050505;
    border-right:2px solid #39a6ff;
    position:fixed;
    left:0;
    top:0;
    padding-top:30px;
    overflow:auto;
}

.logo{
    text-align:center;
    font-size:24px;
    font-weight:bold;
    margin-bottom:40px;
}

.menu{
    display:flex;
    flex-direction:column;
}

.menu a{
    color:#39ff88;
    text-decoration:none;
    padding:18px 25px;
    border-bottom:1px solid rgba(17, 144, 230, 0.78);
    transition:.3s;
    text-align:center;
}

.menu a:hover{
    background:#39ff88;
    color:#000;
}

.content{
    margin-left:250px;
    padding:40px;
}

.cards{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:25px;
    margin-top:30px;
}

.card{
    border:2px solid #39b0ff;
    padding:30px;
    border-radius:10px;
    background:#050505;
    box-shadow:0 0 15px rgba(57, 215, 255, 0.89);
}

.card h2{
    margin:0 0 10px;
}

input{
    padding:10px;
    background:#000;
    color:#39ff88;
    border:1px solid #39ff88;
    margin-bottom:10px;
    width:100%;
}

button{
    padding:10px;
    background:#39ff88;
    border:none;
    cursor:pointer;
    width:100%;
    margin-bottom:10px;
}

.historial{
    margin-top:40px;
    border-top:2px solid #39a6ff;
    padding-top:20px;
}
.btn-eliminar{

    background:#ff3b3b;

    color:white;

    border:none;

    padding:8px 14px;

    border-radius:8px;

    cursor:pointer;

    font-weight:bold;

    transition:.3s;

}

.btn-eliminar:hover{

    background:#d62828;

}
.alert-success{

    width:90%;
    margin:15px auto;

    background:#0d2b18;

    border:2px solid #39ff88;

    color:#39ff88;

    padding:15px;

    border-radius:10px;

    text-align:center;

    font-weight:bold;

}

.alert-error{

    width:90%;
    margin:15px auto;

    background:#3b0d0d;

    border:2px solid #ff4d4d;

    color:#ff8a8a;

    padding:15px;

    border-radius:10px;

    text-align:center;

    font-weight:bold;

}
</style>

</head>
@if(session('success'))

<div class="alert-success">
    {{ session('success') }}
</div>

@endif


@if(session('error'))

<div class="alert-error">
    {{ session('error') }}
</div>

@endif
<body>

<div class="sidebar">

    <div class="logo">
        TEC SYSTEM
    </div>

    <div class="menu">

        {{-- BUSCADOR --}}
        <form method="GET" action="/panel">
            <input type="text" name="buscar" placeholder="Buscar año">
        </form>

        {{-- AÑOS ACTIVOS --}}
        @foreach($anios as $anio)

            <a href="/panel/{{ $anio->id }}">
            {{ $anio->anio }}
            </a>

            <form action="{{ route('anios.destroy', $anio->id) }}" method="POST">
                @csrf
                @method('DELETE')

                <button type="submit">
                    Enviar al historial
                </button>
            </form>

            <td>

    <form id="formEliminarAnio"
      action="{{ route('anios.eliminar', $anio->id) }}"
      method="POST">

    @csrf
    @method('DELETE')

    <input
        type="hidden"
        name="confirmar"
        id="confirmarEliminar"
        value="1">

    <button
        type="button"
        class="btn-eliminar"
        id="btnEliminarAnio">

        Eliminar Año

    </button>

</form>
</td>

        @endforeach

        {{-- HISTORIAL --}}
        <div class="historial">

            <h3>Historial</h3>

            @foreach($historial as $anio)

                <p>{{ $anio->anio }}</p>

                <form action="{{ route('anios.activar', $anio->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <button type="submit">
                        Reactivar
                    </button>
                </form>

            @endforeach

        </div>

        @if ($errors->any())
            <div>
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

    </div>

</div>

<div class="content">

    <h1>Bienvenido al Sistema</h1>

    <div class="cards">
        <a href="/estudiantes" style="text-decoration:none; color:inherit;">
            <div class="card">
                <h2>Estudiantes</h2>
                <p>Gestión de estudiantes</p>
            </div>
        </a>

        <a href="/examenes" style="text-decoration:none; color:inherit;">
            <div class="card">
                <h2>Exámenes</h2>
                <p>Control de exámenes de inglés</p>
            </div>
        </a>

        <a href="/calificaciones" style="text-decoration:none; color:inherit;">
            <div class="card">
                <h2>Calificaciónes</h2>
                <p>Consultar las calificaciones del alumno</p>
            </div>
        </a>

        <a href="/reportes" style="text-decoration:none; color:inherit;">
            <div class="card">
                <h2>Reportes</h2>
                <p>Consultas y estadísticas</p>
            </div>
        </a>

        <a href="/carreras" style="text-decoration:none; color:inherit;">
            <div class="card">
                <h2>Carreras</h2>
                <p>Consultar y gestionar carreras</p>
            </div>
        </a>


    </div>

    <!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Dashboard</title>


<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<style>


body{
    margin:0;
    background:#0a0a0a;
    color:#39ff88;
    font-family:Consolas, monospace;
}


.sidebar{
    width:250px;
    height:100vh;
    background:#050505;
    border-right:2px solid #39a6ff;
    position:fixed;
    left:0;
    top:0;
    padding-top:30px;
    overflow:auto;
}


.logo{
    text-align:center;
    font-size:24px;
    font-weight:bold;
    margin-bottom:40px;
}


.menu{
    display:flex;
    flex-direction:column;
}


.menu a{
    color:#39ff88;
    text-decoration:none;
    padding:18px 25px;
    border-bottom:1px solid rgba(17,144,230,0.78);
    transition:.3s;
    text-align:center;
}


.menu a:hover{
    background:#39ff88;
    color:#000;
}


.content{
    margin-left:250px;
    padding:40px;
}


.cards{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:25px;
    margin-top:30px;
}


.card{
    border:2px solid #39b0ff;
    padding:30px;
    border-radius:10px;
    background:#050505;
    box-shadow:0 0 15px rgba(57,215,255,0.89);
}


.card h2{
    margin:0 0 10px;
}


input{

    padding:10px;
    background:#000;
    color:#39ff88;
    border:1px solid #39ff88;
    margin-bottom:10px;
    width:100%;

}


button{

    padding:10px;
    background:#39ff88;
    border:none;
    cursor:pointer;
    width:100%;
    margin-bottom:10px;

}


.btn-eliminar{

    background:#ff3b3b;

    color:white;

    border:none;

    padding:8px 14px;

    border-radius:8px;

    cursor:pointer;

    font-weight:bold;

    transition:.3s;

}


.btn-eliminar:hover{

    background:#d62828;

}


.historial{

    margin-top:40px;

    border-top:2px solid #39a6ff;

    padding-top:20px;

}



.alert-success{


    width:90%;

    margin:15px auto;

    background:#0d2b18;

    border:2px solid #39ff88;

    color:#39ff88;

    padding:15px;

    border-radius:10px;

    text-align:center;

    font-weight:bold;


}



.alert-error{


    width:90%;

    margin:15px auto;

    background:#3b0d0d;

    border:2px solid #ff4d4d;

    color:#ff8a8a;

    padding:15px;

    border-radius:10px;

    text-align:center;

    font-weight:bold;


}



/* SweetAlert adaptado al tema */

.swal2-popup{

    background:#050505 !important;

    color:white !important;

    border:2px solid #39ff88;

    font-family:Consolas, monospace;

}


.swal2-title{

    color:#39ff88 !important;

}


.swal2-confirm{

    background:#ff3b3b !important;

}


.swal2-cancel{

    background:#39ff88 !important;

    color:#000 !important;

}


</style>


</head>
<body>


<div class="sidebar">


<div class="logo">
    TEC SYSTEM
</div>


<div class="menu">


    {{-- MENSAJES --}}

    @if(session('success'))

        <div class="alert-success">
            {{ session('success') }}
        </div>

    @endif



    @if(session('error'))

        <div class="alert-error">
            {{ session('error') }}
        </div>

    @endif



    {{-- BUSCADOR DE AÑO --}}

    <form method="GET" action="/panel">

        <input 
            type="text" 
            name="buscar" 
            placeholder="Buscar año">

    </form>





    {{-- AÑOS ACTIVOS --}}

    @foreach($anios as $anio)


        <a href="/panel/{{ $anio->id }}">

            {{ $anio->anio }}

        </a>



        {{-- ENVIAR AL HISTORIAL --}}

        <form 
            action="{{ route('anios.destroy',$anio->id) }}" 
            method="POST">

            @csrf

            @method('DELETE')


            <button type="submit">

                Enviar al historial

            </button>


        </form>





        {{-- ELIMINAR DEFINITIVAMENTE --}}


        <form 
            id="formEliminarAnio{{ $anio->id }}"
            action="{{ route('anios.eliminar',$anio->id) }}"
            method="POST">


            @csrf

            @method('DELETE')



            <button

                type="button"

                class="btn-eliminar"

                onclick="confirmarEliminar(
                    {{ $anio->id }},
                    '{{ $anio->anio }}'
                )">


                Eliminar Año


            </button>


        </form>



    @endforeach





    {{-- HISTORIAL --}}


    <div class="historial">


        <h3>
            Historial
        </h3>



        @foreach($historial as $anio)



            <p>

                {{ $anio->anio }}

            </p>



            <form 
                action="{{ route('anios.activar',$anio->id) }}" 
                method="POST">


                @csrf

                @method('PUT')



                <button type="submit">

                    Reactivar

                </button>



            </form>



        @endforeach



    </div>





    {{-- ERRORES DE VALIDACION --}}


    @if ($errors->any())


        <div class="alert-error">


            @foreach ($errors->all() as $error)


                <p>
                    {{ $error }}
                </p>


            @endforeach


        </div>


    @endif





    {{-- FORMULARIO AGREGAR AÑO --}}


    <form action="/anios" method="POST">


        @csrf



        <input

            type="number"

            name="anio"

            placeholder="Ingresa un año">



        <button type="submit">

            Guardar Año

        </button>



    </form>



</div>
<div class="content">


    <h1>
        Bienvenido al Sistema
    </h1>



    <div class="cards">



        <a href="/estudiantes" style="text-decoration:none; color:inherit;">

            <div class="card">

                <h2>
                    Estudiantes
                </h2>

                <p>
                    Gestión de estudiantes
                </p>

            </div>

        </a>





        <a href="/examenes" style="text-decoration:none; color:inherit;">

            <div class="card">

                <h2>
                    Exámenes
                </h2>

                <p>
                    Control de exámenes de inglés
                </p>

            </div>

        </a>





        <a href="/calificaciones" style="text-decoration:none; color:inherit;">

            <div class="card">

                <h2>
                    Calificaciones
                </h2>

                <p>
                    Consultar las calificaciones del alumno
                </p>

            </div>

        </a>





        <a href="/reportes" style="text-decoration:none; color:inherit;">

            <div class="card">

                <h2>
                    Reportes
                </h2>

                <p>
                    Consultas y estadísticas
                </p>

            </div>

        </a>





        <a href="/carreras" style="text-decoration:none; color:inherit;">

            <div class="card">

                <h2>
                    Carreras
                </h2>

                <p>
                    Consultar y gestionar carreras
                </p>

            </div>

        </a>



    </div>


</div>





<script>


function confirmarEliminar(id, anio){



    Swal.fire({


        title: '¿Eliminar año ' + anio + '?',


        text: 'Este proceso eliminará los exámenes, calificaciones y comprobantes relacionados. Esta acción no se puede deshacer.',


        icon: 'warning',


        showCancelButton:true,


        confirmButtonText:'Sí, eliminar',


        cancelButtonText:'Cancelar',


        confirmButtonColor:'#ff3b3b',


        cancelButtonColor:'#39ff88'



    }).then((resultado)=>{


        if(resultado.isConfirmed){


            document

            .getElementById(
                'formEliminarAnio' + id
            )

            .submit();



        }



    });



}




@if(session('eliminado'))


Swal.fire({


    icon:'success',


    title:'Eliminado',


    text:'{{ session("eliminado") }}',


    confirmButtonColor:'#39ff88'


});


@endif



@if(session('success'))


Swal.fire({


    icon:'success',


    title:'Correcto',


    text:'{{ session("success") }}',


    confirmButtonColor:'#39ff88'


});


@endif



@if(session('error'))


Swal.fire({


    icon:'error',


    title:'Error',


    text:'{{ session("error") }}',


    confirmButtonColor:'#ff3b3b'


});


@endif



</script>




</body>

</html>
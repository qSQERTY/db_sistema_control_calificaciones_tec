@use('Illuminate\Support\Facades\Storage')

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Control de Exámenes</title>


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


.top{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:25px;
}


.btn{
    background:#39ff88;
    color:#000;
    padding:12px 20px;
    text-decoration:none;
    font-weight:bold;
    border:none;
    cursor:pointer;
}


table{
    width:100%;
    border-collapse:collapse;
    background:#050505;
}


th{
    background:#001f2e;
}


th, td{
    border:1px solid #00ccff;
    padding:15px;
    text-align:center;
}


tr:hover{
    background:#111;
}


.buscar{
    margin-bottom:20px;
}


.buscar input{
    width:300px;
    padding:12px;
    background:#000;
    color:#39ff88;
    border:1px solid #00ccff;
}


.edit{
    background:#39ff88;
    color:#000;
    padding:8px 12px;
    text-decoration:none;
}


.delete{
    background:red;
    color:white;
    border:none;
    padding:8px 12px;
    cursor:pointer;
}


.add-btn{
    display:inline-block;
    margin-bottom:20px;
    padding:12px 20px;
    background:#39ff88;
    color:#000;
    text-decoration:none;
    font-weight:bold;
}


.back-btn{
    display:inline-block;
    margin-bottom:20px;
    padding:12px 20px;
    background:#39c0ff;
    color:#000;
    text-decoration:none;
    font-weight:bold;
    border-radius:5px;
}


.back-btn:hover{
    background:#39ff88;
}


/* Modal del comprobante */

.modal{
    display:none;
    position:fixed;
    z-index:1000;
    left:0;
    top:0;
    width:100%;
    height:100%;
    background:rgba(0,0,0,.8);
}


.modal-content{

    background:#050505;
    margin:5% auto;
    width:80%;
    height:80%;
    border:2px solid #00ccff;
    padding:20px;

}


.close{

    color:#39ff88;
    float:right;
    font-size:30px;
    cursor:pointer;

}


iframe{

    width:100%;
    height:90%;
    border:none;

}
.buscar{
    margin:10px 0;
}

.buscar form{
    display:flex;
    align-items:center;
    gap:10px;
    flex-wrap:nowrap;   /* Evita que se baje */
}

.search-box{
    display:flex;
    align-items:center;

    width:280px;      /* Ajusta el tamaño */

    background:#000;
    border:2px solid #39ff88;
    border-radius:8px;
    overflow:hidden;
}

.icono{

    color:#39ff88;

    font-size:16px;

    padding:0 10px;
}

.search-box input{

    width:100%;

    background:transparent;

    border:none;

    color:#39ff88;

    padding:8px;

    font-size:15px;

    outline:none;

    font-family:Consolas, monospace;
}

.search-box input::placeholder{

    color:#39ff88;
    opacity:.7;
}

.buscar-btn{

    background:#0b0b0b;

    color:#39ff88;

    border:2px solid #39ff88;

    padding:8px 16px;

    cursor:pointer;

    font-size:15px;

    border-radius:8px;

    transition:.25s;
    
    white-space:nowrap;

}

.buscar-btn:hover{

    background:#39ff88;
    color:#000;
}

.limpiar-btn{

    background:#0b0b0b;

    color:#00ccff;

    border:2px solid #00ccff;

    padding:8px 16px;

    text-decoration:none;

    border-radius:8px;

    font-size:15px;

    transition:.25s;
}

.limpiar-btn:hover{

    background:#00ccff;
    color:#000;
}

</style>

</head>


<body>


<h1>CONTROL DE EXÁMENES</h1>


<a href="/examenes-form" class="btn">
    + Agregar Examen
</a>


<a href="{{ route('panel') }}" class="back-btn">
    Volver al Menú Principal
</a>



<form method="GET" action="/examenes">


    <div class="buscar">

    <form method="GET" action="/examenes">

        <div class="search-box">

            <span class="icono"></span>

            <input
                type="text"
                name="buscar"
                placeholder="Buscar estudiante..."
                value="{{ request('buscar') }}">

        </div>

        <button type="submit" class="buscar-btn">
            Buscar
        </button>

        @if(request('buscar'))
        <a href="{{ route('examenes.index') }}" class="limpiar-btn">
            ⟳ Limpiar
        </a>
        @endif

    </form>

</div>  


</form>




<table>


<thead>

<tr>

<th>ID</th>
<th>Alumno</th>
<th>Tipo</th>
<th>Fecha</th>
<th>Archivo</th>
<th>Acciones</th>

</tr>

</thead>



<tbody>


@forelse($examenes as $examen)


<tr>


<td>
{{ $examen->id }}
</td>


<td>
{{ $examen->estudiante->nombre_completo ?? 'Sin estudiante' }}
</td>


<td>
{{ $examen->tipo_examen }}
</td>


<td>
{{ $examen->fecha }}
</td>




<td>


@if($examen->comprobante_pago)


<button 
class="edit"
onclick="mostrarComprobante('{{ route('examenes.comprobante', $examen->id) }}')">

Ver comprobante

</button>


@else

Sin archivo

@endif


</td>



<td>





<form action="/examenes/{{ $examen->id }}" method="POST" style="display:inline;">


@csrf
@method('DELETE')


<button type="submit" class="delete">

Eliminar

</button>


</form>


</td>


</tr>



@empty


<tr>

<td colspan="7">

No hay exámenes registrados.

</td>

</tr>


@endforelse


</tbody>


</table>




<!-- VENTANA DEL PDF -->


<div id="modalPDF" class="modal">


<div class="modal-content">


<span class="close" onclick="cerrarComprobante()">

&times;

</span>


<h2>
Comprobante de pago
</h2>


<iframe id="pdfFrame"></iframe>


</div>


</div>





<script>


function mostrarComprobante(url)
{

    document.getElementById("modalPDF").style.display="block";

    document.getElementById("pdfFrame").src=url;

}



function cerrarComprobante()
{

    document.getElementById("modalPDF").style.display="none";

    document.getElementById("pdfFrame").src="";

}



</script>



</body>

</html>
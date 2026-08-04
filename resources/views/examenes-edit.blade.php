
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Examen</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<style>


body{

    background:rgb(10,10,10);

    color:rgb(57,255,136);

    font-family:Consolas, monospace;

    display:flex;

    justify-content:center;

    align-items:center;

    height:100vh;

}





form{


    width:400px;

    border:2px solid rgb(57,166,255);

    padding:30px;

    border-radius:10px;

    background:rgb(5,5,5);

    box-shadow:

    0 0 20px rgba(57,166,255,.35);


}





h1{


    text-align:center;

    margin-bottom:25px;

    color:rgb(57,255,136);


}





input,
select{


    width:100%;

    padding:12px;

    margin-bottom:20px;

    background:#000;

    border:1px solid rgb(57,166,255);

    border-radius:6px;

    color:rgb(57,255,136);

    font-family:Consolas, monospace;

    outline:none;


}





input:focus,
select:focus{


    border-color:rgb(57,255,136);

    box-shadow:

    0 0 8px rgba(57,255,136,.6);


}





button{


    width:100%;

    padding:14px;

    background:rgb(57,255,136);

    color:#000;

    border:none;

    border-radius:6px;

    font-weight:bold;

    cursor:pointer;

    font-family:Consolas, monospace;

    transition:.3s;


}





button:hover{


    background:rgb(40,220,110);

    box-shadow:

    0 0 12px rgba(57,255,136,.6);


}





.back-btn{


    display:block;

    text-align:center;

    margin-top:20px;

    color:rgb(57,166,255);

    text-decoration:none;

    font-weight:bold;


}





.back-btn:hover{


    color:rgb(57,255,136);


}



</style>

<body>

    <div class="container">

        <h1>EDITAR EXAMEN</h1>

        <form action="{{ route('examenes.update', $examen->id) }}" method="POST" enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <label>Estudiante</label>

            <select name="estudiante_id" required>

                <option value="">
                    Seleccione un estudiante
                </option>

                @foreach($estudiantes as $estudiante)

                    <option
                        value="{{ $estudiante->id }}"
                        {{ old('estudiante_id', $examen->estudiante_id) == $estudiante->id ? 'selected' : '' }}>

                        {{ $estudiante->nombre_completo }}

                    </option>

                @endforeach

            </select>
        <label>Tipo de Examen</label>

<select name="tipo_examen" id="tipo_examen" required>

    <option value="">Seleccione un tipo de examen</option>

    <option value="Examen de Ubicación">
        Examen de Ubicación
    </option>

    <option value="Examen General de 4 Habilidades">
        Examen General de 4 Habilidades
    </option>

    <option value="TOEFL ITP">
        TOEFL ITP
    </option>

    <option value="Speaking por Certificación">
        Speaking por Certificación
    </option>

</select>

<br><br>

<div id="descripcion"
     style="padding:12px; border:1px solid #ccc; border-radius:5px; background:#000000;">

    Seleccione un tipo de examen para ver su descripción.

</div>

<script>

document.getElementById("tipo_examen").addEventListener("change", function () {

    let descripcion = "";

    switch (this.value) {

        case "Examen de Ubicación":
            descripcion = "<strong>Examen de Ubicación</strong><br>Permite determinar el nivel de dominio del idioma inglés del estudiante para asignarlo al curso o nivel correspondiente.";
            break;

        case "Examen General de 4 Habilidades":
            descripcion = "<strong>Examen General de 4 Habilidades</strong><br>Evalúa las cuatro habilidades del idioma inglés: <b>Reading</b>, <b>Writing</b>, <b>Listening</b> y <b>Speaking</b>.";
            break;

        case "TOEFL ITP":
            descripcion = "<strong>TOEFL ITP</strong><br>Examen institucional que certifica el nivel de inglés. Evalúa comprensión auditiva (Listening), estructura y gramática (Structure and Written Expression) y comprensión lectora (Reading).";
            break;

        case "Speaking por Certificación":
            descripcion = "<strong>Speaking por  Certificación</strong><br>Evaluación utilizada para acreditar oficialmente el dominio del idioma inglés y obtener una certificación emitida por el Centro de Lenguas.";
            break;

        default:
            descripcion = "Seleccione un tipo de examen para ver su descripción.";

    }

    document.getElementById("descripcion").innerHTML = descripcion;

});

</script>


            <label>Fecha</label>

            <input
                type="date"
                name="fecha"
                value="{{ old('fecha', $examen->fecha) }}"
                required>

           

            <label>Comprobante de Pago</label>

            <input
                type="file"
                name="comprobante_pago"
                accept=".pdf,.jpg,.jpeg,.png">

            @if($examen->comprobante_pago)

                <p>
                    Archivo actual:
                    <a href="{{ asset('storage/'.$examen->comprobante_pago) }}" target="_blank">
                        Ver archivo
                    </a>
                </p>

            @endif

            <div class="botones">

                <a href="{{ route('examenes.index') }}" class="btn cancelar">
                    Cancelar
                </a>

                <button type="submit" class="btn guardar">
                    Guardar Cambios
                </button>

            </div>

        </form>

    </div>

</body>

</html>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Registro de Examen</title>

<style>

body{
    background:#0a0a0a;
    color:#39ff88;
    font-family:Consolas, monospace;
    display:flex;
    justify-content:center;
    align-items:center;
    min-height:100vh;
}

form{
    width:450px;
    border:2px solid #39c0ff;
    padding:30px;
    border-radius:10px;
    background:#050505;
}

h1{
    text-align:center;
    margin-bottom:25px;
}

input,
select{
    width:100%;
    padding:12px;
    margin-bottom:20px;
    background:#000;
    border:1px solid #39e1ff;
    color:#39ff88;
}

button{
    width:100%;
    padding:14px;
    background:#39ff88;
    color:#000;
    border:none;
    font-weight:bold;
    cursor:pointer;
}

.back-btn{
    display:block;
    text-align:center;
    margin-top:20px;
    color:#39ff88;
    text-decoration:none;
}

.error{
    color:red;
    text-align:center;
    margin-bottom:15px;
}

.success{
    color:#39ff88;
    text-align:center;
    margin-bottom:15px;
}

</style>

</head>
<body>

<form action="/examenes"
      method="POST"
      enctype="multipart/form-data">

    @csrf

    <h1>REGISTRO EXAMEN</h1>

    @if(session('error'))
        <p class="error">
            {{ session('error') }}
        </p>
    @endif

    @if(session('success'))
        <p class="success">
            {{ session('success') }}
        </p>
    @endif

    <select name="estudiante_id">

        @foreach($estudiantes as $estudiante)

            <option value="{{ $estudiante->id }}">
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
            descripcion = "<strong>Speaking por certificacion</strong><br>Evaluación utilizada para acreditar oficialmente el dominio del idioma inglés y obtener una certificación emitida por el Centro de Lenguas.";
            break;

        default:
            descripcion = "Seleccione un tipo de examen para ver su descripción.";

    }

    document.getElementById("descripcion").innerHTML = descripcion;

});

</script>

    <input type="date"
           name="fecha">


    <input type="file"
           name="comprobante_pago">

     <a href="{{ route('examenes.index') }}" class="btn cancelar">
                    Retroceder
                </a>

    <button type="submit">
        GUARDAR EXAMEN
    </button>

    <a href="/examenes" class="back-btn">

</form>

</body>
</html>
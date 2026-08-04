<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Nuevo Estudiante</title>

<style>


body{

    background:rgb(10,10,10);

    color:rgb(57,255,136);

    font-family:Consolas, monospace;

    display:flex;

    justify-content:center;

    align-items:flex-start;

    min-height:100vh;

    padding-top:50px;

}




form{

    width:450px;

    border:2px solid rgb(57,166,255);

    padding:30px;

    border-radius:10px;

    background:rgb(5,5,5);

    margin-bottom:100px;

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
    0 0 10px rgba(57,255,136,.7);


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

</head>
<body>

<form action="/estudiantes" method="POST">

    @csrf

    <h1>NUEVO ESTUDIANTE</h1>

    <input
        type="text"
        name="numero_control"
        placeholder="Número de control"
        value="{{ old('numero_control', $estudiante->numero_control ?? '') }}"
        required>

    <input
        type="text"
        name="nombre_completo"
        placeholder="Nombre completo"
        value="{{ old('nombre_completo', $estudiante->nombre_completo ?? '') }}"
        required>

    <input
        type="email"
        name="correo"
        placeholder="Correo electrónico"
        value="{{ old('correo', $estudiante->correo ?? '') }}"
        required>

    <label>Carrera</label>

    <select name="carrera_id" required>

        <option value="">
            Seleccione una carrera
        </option>

        @foreach($carreras as $carrera)

            <option
                value="{{ $carrera->id }}"
                {{ old('carrera_id', $estudiante->carrera_id ?? '') == $carrera->id ? 'selected' : '' }}>

                {{ $carrera->nombre }}

            </option>

        @endforeach

    </select>

    <input
        type="text"
        name="horario"
        placeholder="Horario"
        value="{{ old('horario', $estudiante->horario ?? '') }}"
        required>

    <select name="tipo_alumno" required>

        <option value="Regular"
            {{ old('tipo_alumno', $estudiante->tipo_alumno ?? '') == 'Regular' ? 'selected' : '' }}>
            Regular
        </option>

        <option value="Exalumno"
            {{ old('tipo_alumno', $estudiante->tipo_alumno ?? '') == 'Exalumno' ? 'selected' : '' }}>
            Exalumno
        </option>

    </select>
    
    <a href="{{ route('estudiantes.index') }}" class="btn cancelar">
                    Retroceder
                </a>

    <button type="submit">
        GUARDAR
    </button>

    

</form>

</body>
</html>
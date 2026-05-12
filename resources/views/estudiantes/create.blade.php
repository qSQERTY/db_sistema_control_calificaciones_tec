<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Nuevo Estudiante</title>

<style>

body{
    background:#0a0a0a;
    color:#39ff88;
    font-family:Consolas, monospace;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
}

form{
    width:400px;
    border:2px solid #39ff88;
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
    border:1px solid #39ff88;
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

</style>

</head>
<body>

<form action="/estudiantes" method="POST">

    @csrf

    <h1>NUEVO ESTUDIANTE</h1>

    <input type="text" name="numero_control" placeholder="Número de control">

    <input type="text" name="nombre_completo" placeholder="Nombre completo">

    <input type="text" name="carrera" placeholder="Carrera">

    <input type="text" name="horario" placeholder="Horario">

    <select name="tipo_alumno">

        <option value="Regular">Regular</option>

        <option value="Exalumno">Exalumno</option>

    </select>

    <button type="submit">
        GUARDAR
    </button>

    <a href="/dashboard" class="back-btn">
    Regresar al Panel
</a>
</form>

</body>
</html>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nueva Carrera</title>
</head>
<style>


body{

    background:rgb(10,10,10);

    color:rgb(57,255,136);

    font-family:Consolas, monospace;

    display:flex;

    justify-content:center;

    align-items:center;

    min-height:100vh;

}




form{

    width:450px;

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

    transition:.3s;

    font-family:Consolas, monospace;

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





.error{


    color:rgb(255,59,59);

    text-align:center;

    margin-bottom:15px;

    font-weight:bold;

}





.success{


    color:rgb(57,255,136);

    text-align:center;

    margin-bottom:15px;

    font-weight:bold;

}



</style>


<body>

<h1>Agregar Carrera</h1>


<form action="{{ route('carreras.store') }}" method="POST">

    @csrf


    <label>
        Nombre de la carrera
    </label>

    <br>

    <input 
        type="text"
        name="nombre"
        required
    >


    <br><br>


    <button type="submit">
        Guardar
    </button>


</form>


<br>

<a href="{{ route('carreras.index') }}">
    Volver
</a>


</body>
</html>
<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<title>Editar notificación</title>


<style>


*{

    margin:0;

    padding:0;

    box-sizing:border-box;

}





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





.container{

    width:550px;

    background:rgb(5,5,5);

    border:2px solid rgb(57,166,255);

    padding:30px;

    border-radius:10px;

    box-shadow:
    0 0 20px rgba(57,166,255,.35);


}





h1{

    text-align:center;

    color:rgb(57,255,136);

    margin-bottom:25px;


}





label{


    display:block;

    color:rgb(57,166,255);

    font-weight:bold;

    margin-bottom:10px;


}





textarea{


    width:100%;

    height:180px;

    resize:none;

    background:#000;

    color:rgb(57,255,136);

    border:1px solid rgb(57,166,255);

    border-radius:6px;

    padding:12px;

    font-family:Consolas, monospace;

    outline:none;


}





textarea:focus{


    border-color:rgb(57,255,136);

    box-shadow:
    0 0 10px rgba(57,255,136,.7);


}





button{


    width:100%;

    margin-top:20px;

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





.info{


    background:#111;

    border:1px solid rgb(57,166,255);

    padding:15px;

    border-radius:8px;

    margin-bottom:20px;

    color:rgb(57,255,136);


}





.info strong{


    color:rgb(57,166,255);


}





.back-btn{


    display:block;

    margin-top:15px;

    padding:12px;

    text-align:center;

    background:rgb(57,166,255);

    color:#000;

    text-decoration:none;

    border-radius:6px;

    font-weight:bold;


}





.back-btn:hover{


    background:rgb(57,255,136);


}





input{


    width:100%;

    padding:12px;

    background:#000;

    color:rgb(57,255,136);

    border:1px solid rgb(57,166,255);

    border-radius:6px;

    margin-bottom:20px;

    font-family:Consolas, monospace;


}





input:focus{


    border-color:rgb(57,255,136);

    outline:none;

    box-shadow:
    0 0 8px rgba(57,255,136,.6);


}



</style>

</head>


<body>


<div class="container">


<h1>

📧 Editar notificación

</h1>
<div class="info">

    <p>
        <strong>Alumno:</strong>
        {{ $estudiante->nombre_completo }}
    </p>


    <p>
        <strong>Correo:</strong>
        {{ $estudiante->correo }}
    </p>

</div>
<form method="POST"
      action="{{ route('estudiantes.notificar.enviar', $estudiante->id) }}">

    @csrf

    <label>
    Asunto:
</label>


<input 
    type="text"
    name="asunto"
    placeholder="Escribe el asunto del correo"
    value="Notificación de examen"
    required>


    <label>
        Mensaje:
    </label>


    <textarea 
        name="mensaje"
        placeholder="Escribe la notificación..."
        required></textarea>


    <button type="submit">

        📧 Enviar mensaje

    </button>


</form>


<a href="{{ route('calendario.index') }}" class="back-btn">
    Regresar al calendario
</a>

</a>
</div>

</body>

</html>
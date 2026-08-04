<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Recuperar acceso</title>

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
    background:#050505;
    border:2px solid #39c0ff;
    padding:30px;
    border-radius:10px;
}

h1{
    text-align:center;
}

input{
    width:100%;
    padding:12px;
    margin-top:20px;
    background:#000;
    border:1px solid #39ff88;
    color:#39ff88;
}

button{
    width:100%;
    margin-top:20px;
    padding:12px;
    background:#39ff88;
    border:none;
    font-weight:bold;
}

a{
    display:block;
    margin-top:20px;
    text-align:center;
    color:#39c0ff;
}

</style>

</head>

<body>


<form method="POST" action="{{ route('password.email') }}">

@csrf

<h1>
RECUPERAR ACCESO
</h1>


<input 
type="email"
name="email"
placeholder="Correo electrónico"
required>


<button>
ENVIAR ENLACE
</button>


<a href="{{ route('login') }}">
Volver al login
</a>


</form>


</body>
</html>
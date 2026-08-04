<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Crear Perfil | TEC SYSTEM</title>


<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}


body{

    background:#090909;
    min-height:100vh;

    display:flex;
    justify-content:center;
    align-items:center;

    font-family:Consolas, monospace;

    color:#39ff88;

}



/* CONTENEDOR */

.register-container{

    width:450px;

}



.cyber-terminal{

    background:#020202;

    border:2px solid #39ff88;

    border-radius:10px;

    overflow:hidden;

    box-shadow:
    0 0 25px rgba(57,255,136,.4);

}



/* HEADER */

.terminal-header{

    height:55px;

    background:#111;

    border-bottom:1px solid #39ff88;

    display:flex;

    align-items:center;

    justify-content:space-between;

    padding:0 20px;

}



.terminal-buttons{

    display:flex;

    gap:8px;

}



.term-btn{

    width:13px;
    height:13px;
    border-radius:50%;

}


.red{
    background:#ff5555;
}


.yellow{
    background:#ffff55;
}


.green{
    background:#39ff88;
}



.terminal-title{

    color:#39ff88;

    font-size:14px;

    font-weight:bold;

}



/* CONTENIDO */


.content{

    padding:35px;

}



h1{

    text-align:center;

    color:#39ff88;

    margin-bottom:10px;

    letter-spacing:3px;

}



.subtitle{

    text-align:center;

    color:#39c0ff;

    font-size:12px;

    margin-bottom:30px;

}



/* ERRORES */

.error{

    background:#ff5555;

    color:#000;

    padding:10px;

    margin-bottom:20px;

    border-radius:5px;

    font-weight:bold;

}



.success{

    background:#39ff88;

    color:#000;

    padding:10px;

    margin-bottom:20px;

    border-radius:5px;

}



/* CAMPOS */


.field{

    margin-bottom:20px;

}



label{

    display:block;

    margin-bottom:8px;

    color:#39c0ff;

    font-weight:bold;

}



input{

    width:100%;

    padding:14px;

    background:#000;

    border:1px solid #39ff88;

    color:#39ff88;

    border-radius:6px;

    outline:none;

    font-family:Consolas, monospace;

}



input:focus{

    box-shadow:0 0 10px #39ff88;

    border-color:#39ff88;

}



/* BOTON */


button{

    width:100%;

    padding:15px;

    background:#39ff88;

    color:#000;

    border:none;

    border-radius:6px;

    font-weight:bold;

    font-family:Consolas, monospace;

    cursor:pointer;

    font-size:15px;

}



button:hover{

    background:#39c0ff;

}



/* LINK */


.back{

    display:block;

    text-align:center;

    margin-top:20px;

    color:#39ff88;

    text-decoration:none;

}



.back:hover{

    color:#39c0ff;

}


</style>


</head>



<body>



<div class="register-container">


<div class="cyber-terminal">


<div class="terminal-header">


<div class="terminal-buttons">

<div class="term-btn red"></div>
<div class="term-btn yellow"></div>
<div class="term-btn green"></div>

</div>


<div class="terminal-title">

TEC_REGISTER

</div>


</div>





<div class="content">



<h1>

CREAR PERFIL

</h1>


<p class="subtitle">

[ NUEVO_USUARIO_DEL_SISTEMA ]

</p>





@if($errors->any())

<div class="error">

@foreach($errors->all() as $error)

<p>{{ $error }}</p>

@endforeach

</div>

@endif





@if(session('success'))

<div class="success">

{{ session('success') }}

</div>

@endif





<form method="POST" action="{{ route('register.post') }}">

@csrf




<div class="field">

<label>

> NOMBRE

</label>


<input

type="text"

name="name"

value="{{ old('name') }}"

required

>

</div>





<div class="field">

<label>

> CORREO ELECTRONICO

</label>


<input

type="email"

name="email"

value="{{ old('email') }}"

required

>

</div>





<div class="field">

<label>

> CONTRASEÑA

</label>


<input

type="password"

name="password"

required

>

</div>





<div class="field">

<label>

> CONFIRMAR CONTRASEÑA

</label>


<input

type="password"

name="password_confirmation"

required

>

</div>





<button type="submit">

[ CREAR CUENTA ]

</button>



</form>





<a href="{{ route('login') }}" class="back">

&lt; VOLVER AL LOGIN &gt;

</a>



</div>


</div>


</div>



</body>

</html>
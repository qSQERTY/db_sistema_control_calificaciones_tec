<!DOCTYPE html>
<html lang="es">
<head>

<meta charset="UTF-8">

<title>Nueva contraseña</title>

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

h2{
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
    cursor:pointer;
}

.error{
    color:red;
    margin-top:10px;
}

</style>

</head>

<body>

<form method="POST" action="{{ route('password.guardar') }}">

    @csrf

    <h2>NUEVA CONTRASEÑA</h2>

    <input
        type="password"
        name="password"
        placeholder="Nueva contraseña"
        required>

    @error('password')
        <div class="error">{{ $message }}</div>
    @enderror

    <input
        type="password"
        name="password_confirmation"
        placeholder="Confirmar contraseña"
        required>

    <button>
        GUARDAR CONTRASEÑA
    </button>

</form>

</body>
</html>
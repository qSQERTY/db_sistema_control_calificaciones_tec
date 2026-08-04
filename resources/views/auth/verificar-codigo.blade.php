<!DOCTYPE html>
<html lang="es">
<head>

<meta charset="UTF-8">

<title>Verificar código</title>

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
    margin-top:15px;
}

</style>

</head>

<body>

<form method="POST" action="{{ route('password.verificar') }}">

    @csrf

    <h2>VERIFICAR CÓDIGO</h2>

    <input
        type="hidden"
        name="email"
        value="{{ session('email') }}">

    <input
        type="text"
        name="codigo"
        maxlength="6"
        placeholder="Código de 6 dígitos"
        required>

    @error('codigo')
        <div class="error">{{ $message }}</div>
    @enderror

    <button>
        VERIFICAR
    </button>

</form>

</body>
</html>
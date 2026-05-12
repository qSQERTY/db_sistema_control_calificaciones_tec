<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard</title>

<style>

body{
    margin:0;
    background:#0a0a0a;
    color:#39ff88;
    font-family:Consolas, monospace;
}

.sidebar{
    width:250px;
    height:100vh;
    background:#050505;
    border-right:2px solid #39ff88;
    position:fixed;
    left:0;
    top:0;
    padding-top:30px;
}

.logo{
    text-align:center;
    font-size:24px;
    font-weight:bold;
    margin-bottom:40px;
}

.menu{
    display:flex;
    flex-direction:column;
}

.menu a{
    color:#39ff88;
    text-decoration:none;
    padding:18px 25px;
    border-bottom:1px solid rgba(57,255,136,.2);
    transition:.3s;
    text-align:center;
}

.menu a:hover{
    background:#39ff88;
    color:#000;
}

.content{
    margin-left:250px;
    padding:40px;
}

.cards{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:25px;
    margin-top:30px;
}

.card{
    border:2px solid #39ff88;
    padding:30px;
    border-radius:10px;
    background:#050505;
    box-shadow:0 0 15px rgba(57,255,136,.2);
}

.card h2{
    margin:0 0 10px;
}

</style>

</head>
<body>

<div class="sidebar">

    <div class="logo">
        TEC SYSTEM
    </div>

    <div class="menu">

        <a href="/dashboard">Dashboard</a>
        <a href="/2024">2024</a>
        <a href="/2025">2025</a>
        <a href="/2026">2026</a>
        <a href="/2027">2027</a>

    </div>

</div>

<div class="content">

    <h1>Bienvenido al Sistema</h1>

    <div class="cards">

        <a href="/usuarios" style="text-decoration:none; color:inherit;">
            <div class="card">
                <h2>Usuarios</h2>
                <p>Administración de usuarios</p>
            </div>
        </a>

        <a href="/estudiantes" style="text-decoration:none; color:inherit;">
            <div class="card">
                <h2>Estudiantes</h2>
                <p>Gestión de estudiantes</p>
            </div>
        </a>

        <a href="/examenes" style="text-decoration:none; color:inherit;">
            <div class="card">
                <h2>Exámenes</h2>
                <p>Control de exámenes de inglés</p>
            </div>
        </a>

        <a href="/reportes" style="text-decoration:none; color:inherit;">
            <div class="card">
                <h2>Reportes</h2>
                <p>Consultas y estadísticas</p>
            </div>
        </a>

    </div>

</div>

</body>
</html>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Reportes</title>

<style>

body{
    margin:0;
    background:#050505;
    color:#39f8ffe1;
    font-family:Consolas, monospace;
}

.container{
    padding:40px;
}

.title{
    font-size:40px;
    margin-bottom:30px;
}

.card{
    border:2px solid #39f8ffe1;
    border-radius:20px;
    padding:25px;
    box-shadow:0 0 20px #39f2ffec;
}

table{
    width:100%;
    border-collapse:collapse;
    margin-top:20px;
}

table th,
table td{
    border:1px solid #30e1f8;
    padding:12px;
    text-align:left;
}

table th{
    background:#111;
}

.btn{
    background:#f8f8f8;
    color:black;
    padding:10px 15px;
    text-decoration:none;
    border-radius:10px;
    font-weight:bold;
    display:inline-block;
}

.btn:hover{
    background:white;
}

.top-buttons{
    margin-bottom:20px;
}
.add-btn{
    display:inline-block;
    margin-bottom:20px;
    padding:12px 20px;
    background:#39ff88;
    color:#000;
    text-decoration:none;
    font-weight:bold;
}
.back-btn{
    display:inline-block;
    margin-bottom:20px;
    padding:12px 20px;
    background:#39c0ff;
    color:#000;
    text-decoration:none;
    font-weight:bold;
    border-radius:5px;
}

.back-btn:hover{
    background:#39ff88;
}


</style>
</head>
<body>

<div class="container">

    <div class="title">
        Panel de Reportes
    </div>

    <a href="{{ route('panel') }}" class="back-btn">
    Volver al Menú Principal
    </a>

    <div class="card">

        <div class="top-buttons">

            <a href="{{ route('reporte.excel') }}"
               class="btn">
               Descargar Excel
            </a>

            <a href="/reporte-general"
               class="btn"
               target="_blank">
               PDF General
            </a>

        </div>

        <h2>Lista de estudiantes</h2>

        <table>

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Carrera</th>
                    <th>No control</th>
                    <th>Horario</th>
                    <th>Acción</th>
                </tr>
            </thead>

            <tbody>

                @foreach($estudiantes as $estudiante)

                <tr>

                    <td>{{ $estudiante->id }}</td>

                    <td>{{ $estudiante->nombre_completo }}</td>

                    <td> {{ $estudiante->carrera->nombre }}</td>

                    <td>{{ $estudiante->numero_control ?? 'Sin no control' }}</td>

                    <td>{{ $estudiante->horario ?? 'Sin horario' }}</td>

                    <td>

                        <a
                        href="/reportes/estudiante/{{ $estudiante->id }}"
                        class="btn"
                        target="_blank"
                        >
                        Generar PDF
                        </a>

                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

</body>
</html>
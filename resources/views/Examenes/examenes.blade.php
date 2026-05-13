<h1>Registro de Exámenes</h1>

@if(session('error'))
    <p>{{ session('error') }}</p>
@endif

<form action="/examenes" method="POST">

    @csrf

    <select name="estudiante_id">

        @foreach($estudiantes as $estudiante)

            <option value="{{ $estudiante->id }}">
                {{ $estudiante->nombre }}
            </option>

        @endforeach

    </select>

    <select name="anio_id">

        @foreach($anios as $anio)

            <option value="{{ $anio->id }}">
                {{ $anio->anio }}
            </option>

        @endforeach

    </select>

    <input type="text" name="tipo_examen" placeholder="Tipo examen">

    <input type="date" name="fecha">

    <input type="number" step="0.01" name="calificacion" placeholder="Calificación">

    <select name="resultado">
        <option value="Aprobado">Aprobado</option>
        <option value="Reprobado">Reprobado</option>
    </select>

    <select name="pago">
        <option value="1">Pagó</option>
        <option value="0">No pagó</option>
    </select>

    <button type="submit">
        Guardar examen
    </button>

</form>
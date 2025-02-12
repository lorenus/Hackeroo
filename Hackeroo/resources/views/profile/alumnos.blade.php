@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-3 volver">
        <div class="col-12 text-left">
            <a href="{{ route('perfil') }}">
                <img src="/img/botones/volver.png" alt="Volver">
            </a>
        </div>
    </div>

    <div class='d-flex justify-content-center align-items-center'>
        @csrf
        <fieldset style="min-height: 50vh;">
            <legend class="text-nowrap">Mis Alumnos</legend>

            <div class="input-group mb-4">
            <x-search-bar id="search" class="form-control" placeholder="Buscar alumno" oninput="filterAlumnos()" />
            </div>

            <div class="tabla-scroll-container">
                <table id="alumnos-table">
                    <thead  style='position: sticky; top:0; background-color: #FFB300; padding-top:2px;'>
                        <tr >
                            <td class='text-center'><h6>Curso</h6></td>
                            <td class='text-center'><h6>Tareas realizadas</h6></td>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($alumnosPorCurso) > 0)
                            @foreach($alumnosPorCurso as $alumno)
                                <tr class="alumno-row nombre-alumno-row">
                                    <td colspan="2">
                                        {{ $alumno['alumno']->nombre }} {{ $alumno['alumno']->apellidos }}
                                    </td>
                                </tr>

                                @foreach($alumno['cursos'] as $curso)
                                    <tr>
                                        <td>
                                            <a href="{{ route('ver.alumno.en.curso', [$alumno['alumno']->DNI, $curso['curso']->id]) }}" style="text-decoration: none; color: inherit; display: block;">
                                                {{ $curso['curso']->nombre }}
                                            </a>
                                        </td>
                                        <td class='text-center'>{{ $curso['tareas_completadas'] }}/{{ $curso['total_tareas'] }}</td>
                                    </tr>
                                @endforeach
                            @endforeach
                        @else
                            <tr>
                                <td colspan="2" class="text-center">No tienes alumnos asociados a tus cursos.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </fieldset>
</div>

    <script>
       function filterAlumnos() {
    const searchTerm = document.getElementById('search').value.toLowerCase();
    const rows = document.querySelectorAll('.nombre-alumno-row');
    
    rows.forEach(row => {
        const nombre = row.querySelector('td').textContent.toLowerCase();
        if (searchTerm === "" || nombre.includes(searchTerm)) {
            row.style.display = '';
            // Mostrar las filas de cursos asociados al alumno
            let nextRow = row.nextElementSibling;
            while (nextRow && !nextRow.classList.contains('nombre-alumno-row')) {
                nextRow.style.display = '';
                nextRow = nextRow.nextElementSibling;
            }
        } else {
            row.style.display = 'none';
            // Ocultar las filas de cursos asociados al alumno
            let nextRow = row.nextElementSibling;
            while (nextRow && !nextRow.classList.contains('nombre-alumno-row')) {
                nextRow.style.display = 'none';
                nextRow = nextRow.nextElementSibling;
            }
        }
    });
}

    </script>

    <style>
      
        .nombre-alumno-row {
            background-color: #ffe5b4;
            font-weight: bold;
        }

        /* Styles for the sticky header */
    </style>
</div>
@endsection
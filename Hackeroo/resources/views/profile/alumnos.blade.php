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

    <form action="#" method="POST" class='d-flex justify-content-center align-items-center'>
        @csrf
        <fieldset style="min-height: 50vh;">
            <legend class="text-nowrap">Mis Alumnos</legend>

            <div class="input-group mb-4">
                <x-search-bar id="search" class="form-control" placeholder="Buscar alumno" />
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
                                        <td class='text-center'>{{ $curso['tareas_completadas'] }}</td>
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
    </form>

    <script>
        function filterAlumnos() {
            const searchTerm = document.getElementById('search').value.toLowerCase();
            const rows = document.querySelectorAll('.alumno-row');
            rows.forEach(row => {
                const nombre = row.querySelector('td:nth-child(1) a').textContent.toLowerCase(); // Select the link text
                if (searchTerm === "" || nombre.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search');
            if (searchInput) {
                searchInput.addEventListener('input', filterAlumnos);
            }

            // Sticky header
            const table = document.getElementById('alumnos-table');
            const thead = table.querySelector('thead');
            const tbody = table.querySelector('tbody');

            tbody.addEventListener('scroll', function() {
                if (tbody.scrollTop > 0) {
                    thead.style.position = 'sticky';
                    thead.style.top = '0';
                    thead.style.zIndex = '1'; // Ensure it's on top
                    thead.style.backgroundColor = '#f2f2f2'; // Set background color
                } else {
                    thead.style.position = 'relative'; // Reset to default when at the top
                    thead.style.backgroundColor = 'transparent'; // Reset background color (or whatever you want)
                }
            });
        });
    </script>

    <style>
        .tabla-scroll-container {
            overflow-y: auto;
            max-height: 50vh;
            /* Adjust as needed */
        }

        #alumnos-table {
            width: 100%;
            border-collapse: collapse;
        }

        #alumnos-table th,
        #alumnos-table td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .nombre-alumno-row {
            background-color: #ffe5b4;
            /* Light orange */
            font-weight: bold;
        }

        /* Styles for the sticky header */
    </style>
</div>
@endsection
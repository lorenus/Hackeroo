@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Botón para volver -->
    <div class="row mb-3 volver">
        <div class="col-12 text-left">
            <a href="{{ route('perfil') }}">
                <img src="/img/botones/volver.png" alt="Volver">
            </a>
        </div>
    </div>

    <form action="#" method="POST" class='d-flex justify-content-center align-items-center'>
        @csrf
        <fieldset>
            <legend>Mis Alumnos</legend>

            <!-- Componente de búsqueda -->
            <div class="input-group mb-4">
                <x-search-bar id="search" class="form-control" placeholder="Buscar alumno por nombre o apellidos" />
            </div>

            <!-- Contenedor de la tabla -->
            <div class="tabla-scroll-container">
                <table id="alumnos-table">
                    <thead>
                        <tr>
                            <td>Nombre</td>
                            <td>Curso</td>
                            <td>Tareas Realizadas</td>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($alumnosPorCurso) > 0)
                        @foreach($alumnosPorCurso as $data)
                        <tr class="alumno-row">
                            <td>
                                <!-- Nombre del alumno -->
                                <a href="{{ route('ver.alumno.en.curso', [$data['alumno']->DNI, $data['curso']->id]) }}" style="text-decoration: none; color: inherit; display: block;">
                                    {{ $data['alumno']->nombre }} {{ $data['alumno']->apellidos }}
                                </a>
                            </td>
                            <td>
                                <!-- Nombre del curso -->
                                <span style="text-decoration: none; color: inherit; display: block;">
                                    {{ $data['curso']->nombre }}
                                </span>
                            </td>
                            <td>
                                <!-- Número de tareas completadas -->
                                <span>{{ $data['tareas_completadas'] }}</span>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <!-- Mensaje si no hay alumnos -->
                        <tr>
                            <td colspan="3" class="text-center">No tienes alumnos asociados a tus cursos.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </fieldset>
    </form>

    <!-- Script para el buscador -->
    <script>
        function filterAlumnos() {
            const searchTerm = document.getElementById('search').value.toLowerCase();
            const rows = document.querySelectorAll('.alumno-row');
            rows.forEach(row => {
                const nombre = row.querySelector('td:nth-child(1)').textContent.toLowerCase();
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
                searchInput.addEventListener('input', filterAlumnos); // Correct event listener
            }
        });
    </script>
</div> <!-- fin contenedor principal-->
@endsection
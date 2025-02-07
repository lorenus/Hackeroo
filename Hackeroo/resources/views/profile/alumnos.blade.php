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
            <div class="tabla-scroll-container">
                <table>
                    <thead>
                        <tr>
                            <td>Nombre</td>
                            <td>Curso</td>
                            <td>Tareas realizadas</td>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($alumnos) > 0)
                        @foreach($alumnos as $index => $alumno)
                        <tr>
                        <tr>
                            <td>
                                <a href="{{ route('ver.alumno', $alumno->DNI) }}" style="text-decoration: none; color: inherit; display: block;">
                                    {{ $alumno->nombre }} {{ $alumno->apellidos }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('ver.alumno', $alumno->DNI) }}" style="text-decoration: none; color: inherit; display: block;">
                                    0
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('ver.alumno', $alumno->DNI) }}" style="text-decoration: none; color: inherit; display: block;">
                                    0
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="3" class="text-center">No tienes alumnos asociados a tus cursos.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </fieldset>
    </form>
</div>
</div> <!-- fin contenedor principal-->

@endsection
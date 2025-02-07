<!-- resources/views/profile/alumnos.blade.php -->

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
                            <th>Nombre</th>
                            <th>Curso 1</th>
                            <th>Curso 2</th>
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
                            <td colspan="2">No tienes alumnos asociados a tus cursos.</td>
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
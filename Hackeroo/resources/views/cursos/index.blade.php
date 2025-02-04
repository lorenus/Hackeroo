@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Botón para volver -->
    <div class="row mb-3">
        <div class="col-12 text-left">
            <a href="{{ route('perfil') }}">
                <img src="/img/botones/volver.png" alt="Volver">
            </a>
        </div>
    </div>

    <!-- Título centrado -->
    <div class="row mb-3">
        <div class="col-12 text-center">
            <h2>Mis Cursos</h2>
        </div>
    </div>

    <!-- Botón para crear nuevo curso -->
    <div class="row mb-3">
        <div class="col-12 text-center">
            <a href="{{ route('cursos.create.step1') }}" class="btn boton">Crear Curso</a>
        </div>
    </div>

    <!-- Mensaje o contenido de los cursos -->
    <div class="row contenido-cursos">
        <div class="col-12">
            @if($cursos->isEmpty())
                <p class="text-center">No tienes cursos creados aún.</p>
            @else
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nombre del Curso</th>
                            <th>Descripción</th>
                            <th>Acciones</th> <!-- Columna para las acciones -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cursos as $curso)
                        <tr>
                            <td>{{ $curso->nombre }}</td>
                            <td>{{ $curso->descripcion }}</td>
                            <td>
                                <!-- Enlace de editar -->
                                <a href="{{ route('cursos.edit', $curso->id) }}" class="btn btn-sm btn-warning">Editar</a>

                                <!-- Enlace de eliminar -->
                                <form action="{{ route('cursos.destroy', $curso->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar este curso?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection
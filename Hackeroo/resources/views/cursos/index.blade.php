@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Mis Cursos</h1>

    @if($cursos->isEmpty())
        <p>No tienes cursos creados aún.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre del Curso</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cursos as $curso)
                    <tr>
                        <td>{{ $curso->nombre }}</td>
                        <td>{{ $curso->descripcion }}</td>
                        <td>
                            <!-- Aquí puedes añadir botones para editar, eliminar, etc. -->
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <!-- Botón para crear nuevo curso -->
    <a href="{{ route('cursos.create.step1') }}" class="btn btn-primary">Crear Nuevo Curso</a>
</div>
<a href="{{ route('cursos.index') }}" class="btn btn-secondary">Mis Cursos</a>

@endsection

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
                    <td>
                        <a href="{{ route('cursos.show', $curso->id) }}">{{ $curso->nombre }}</a>
                    </td>
                    <td>{{ $curso->descripcion }}</td>
                    <td>
                        <a href="{{ route('cursos.edit', $curso->id) }}" class="btn btn-sm btn-warning">Editar</a>

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

    <a href="{{ route('cursos.create.step1') }}" class="btn btn-primary">Crear Nuevo Curso</a>
</div>

<a href="{{ route('profesor.index') }}" class="btn btn-secondary">Volver</a>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $curso->nombre }}</h1>
    <p>{{ $curso->descripcion }}</p>

    <h2>Tareas</h2>
    @if($curso->tareas->isEmpty())
        <p>No hay tareas en este curso.</p>
    @else
        <ul class="list-group">
            @foreach($curso->tareas as $tarea)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong>{{ $tarea->titulo }}</strong>
                    </div>
                    <div>
                        <a href="{{ route('tarea.test.index', $tarea->id) }}" class="btn btn-sm btn-info">Ver</a>
                        <a href="{{ route('tarea.test.edit', $tarea->id) }}" class="btn btn-sm btn-warning">Editar</a>

                        <form action="{{ route('tarea.test.destroy', $tarea->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar esta tarea?')">Eliminar</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif

    <a href="{{ route('tarea.test.create', ['curso_id' => $curso->id]) }}" class="btn btn-success mt-3">Añadir Tarea</a>

    <a href="{{ route('cursos.index') }}" class="btn btn-secondary mt-3">Volver</a>
</div>
@endsection

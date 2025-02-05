@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $curso->nombre }}</h1>
    <p>{{ $curso->descripcion }}</p>
    <a href="{{ route('tarea.create', ['curso_id' => $curso->id]) }}" class="btn btn-primary">
    Añadir contenido
    </a>
    <h2>Tareas del curso</h2>
    @if ($curso->tareas->count() > 0)
        <ul>
            @foreach ($curso->tareas as $tarea)
                <li>
                    <strong>{{ $tarea->titulo }}</strong>
                    <p>{{ $tarea->descripcion }}</p>
                    
                    @if ($tarea->recursoMultimedia->count() > 0) 
                        <!-- Verificar si la tarea tiene recursos asociados -->
                        @foreach ($tarea->recursoMultimedia as $recurso)
                            @if ($recurso->tipo === 'archivo' || $recurso->tipo === 'link')
                                <a href="{{ route('tarea.ver-recurso', ['tarea_id' => $tarea->id]) }}" class="btn btn-secondary">
                                    Ver Recurso
                                </a>
                            @endif
                        @endforeach
                    @endif
                </li>
            @endforeach
        </ul>
    @else
        <p>No hay tareas para este curso.</p>
    @endif
</div>
@endsection

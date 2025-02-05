@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Botón para volver -->
    <div class="row mb-3">
        <div class="col-12 text-left">
            <a href="{{ route('cursos-alumno') }}">
                <img src="/img/botones/volver.png" alt="Volver">
            </a>
        </div>
    </div>

    <!-- Información del Curso -->
    <div class="row mb-3">
        <div class="col-12 text-center">
            <h2>{{ $curso->nombre }}</h2>
            <p>{{ $curso->descripcion }}</p>
        </div>
    </div>

    <!-- Lista de Tareas -->
    <div class="row">
        <div class="col-12">
            <h3 class="text-center">Tareas</h3>
            @if($tareas->isEmpty())
                <p class="text-center">Este curso no tiene tareas asignadas.</p>
            @else
                <ul class="list-group">
                    @foreach($tareas as $tarea)
                        <li class="list-group-item">
                        <a href="{{ route('tareas.show', ['curso_id' => $curso->id, 'tarea_id' => $tarea->id]) }}">{{ $tarea->titulo }}</a>

                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-3">
        <div class="col-12 text-left">
            <a href="{{ route('cursos') }}">
                <img src="/img/botones/volver.png" alt="Volver">
            </a>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-12 text-center">
            <h2>Tareas del curso: {{ $curso->nombre }}</h2>
        </div>
    </div>

    <div class="row contenido-cursos">
        <div class="col-12">
            @if($curso->tareas->isEmpty())
            <p class="text-center">No tienes tareas aún.</p>
            @else
            <div class="contenedor-cursos mw-md-60">
                <div class="row justify-content-center">
                    @foreach($curso->tareas as $tarea)
                    <div class="curso-item col-md-5 ms-md-5 mb-3">
                        <div class="curso-nombre text-center">
                            <a href="{{ route('tarea.ver', ['curso_id' => $curso->id, 'tarea_id' => $tarea->id]) }}" class="text-decoration-none text-dark">
                                <div class="tarea-card">
                                    <h5>{{ $tarea->titulo }}</h5>
                                    <p>{{ $tarea->descripcion }}</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
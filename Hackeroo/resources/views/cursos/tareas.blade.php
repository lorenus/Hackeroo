@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-3">
        <div class="col-12 text-left">
            <a href="@if(Auth::user()->rol == 'profesor') {{ route('cursos') }} @else {{ route('cursos-alumno') }} @endif">
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
                                <div class="tarea-card d-flex flex-column align-items-center">
                                    <!-- Determinar la imagen según el tipo de tarea -->
                                    @if ($tarea->tipo === 'test')
                                    <img src="{{ asset('img/Imagenes/todo.png') }}" alt="Test" class="mb-2">
                                    @elseif ($tarea->tipo === 'link')
                                    <img src="{{ asset('img/Imagenes/link.png') }}" alt="Link" class="mb-2">
                                    @elseif ($tarea->tipo === 'archivo')
                                    <img src="{{ asset('img/Imagenes/apuntes.png') }}" alt="Archivo" class="mb-2">
                                    @endif
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
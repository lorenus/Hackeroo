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
    @if (session('status'))
    <div class="d-flex justify-content-center">
        <div class="alert alert-success d-flex align-items-center w-auto mx-3" role="alert" style="max-width: 500px;">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                <use xlink:href="#check-circle-fill" />
            </svg>
            <div>
                {{ session('status') }}
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
@endif
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
                    <!-- Asignar clase dinámica según el tipo de tarea -->
                    @php
                    $borderClass = ''; // Clase CSS para el borde
                    switch ($tarea->tipo) {
                    case 'test':
                    $borderClass = 'border-test';
                    break;
                    case 'link':
                    $borderClass = 'border-link';
                    break;
                    case 'archivo':
                    $borderClass = 'border-archivo';
                    break;
                    }
                    @endphp
                    <div class="curso-item col-md-5 me-3 mb-3 {{ $borderClass }}">
                        <div class="curso-nombre text-center">
                            <!-- Enlace para descargar archivo o ver tarea -->
                            @if ($tarea->tipo === 'archivo')
                            <!-- Enlace de descarga directa para tipo "archivo" -->
                            <a href="{{ asset('storage/' . $tarea->recursoMultimedia->url) }}"
                                class="text-decoration-none text-dark"
                                download
                                target="_blank"
                                rel="noopener noreferrer">
                                @else
                                <!-- Enlace normal para otros tipos -->
                                <a href="{{ route('tarea.ver', ['curso_id' => $curso->id, 'tarea_id' => $tarea->id]) }}"
                                    class="text-decoration-none text-dark"
                                    @if($tarea->tipo === 'link') target="_blank" rel="noopener noreferrer" @endif>
                                    @endif
                                    <!-- Contenido de la tarjeta -->
                                    <div class="tarea-card d-flex align-items-center p-3">
                                        <!-- Imagen a un lado -->
                                        <div class="me-3">
                                            @if ($tarea->tipo === 'test')
                                            <img src="{{ asset('img/Imagenes/todo.png') }}" alt="Test" class="img-fluid" style="max-width: 80px;">
                                            @elseif ($tarea->tipo === 'link')
                                            <img src="{{ asset('img/Imagenes/link.png') }}" alt="Link" class="img-fluid" style="max-width: 80px;">
                                            @elseif ($tarea->tipo === 'archivo')
                                            <img src="{{ asset('img/Imagenes/apuntes.png') }}" alt="Archivo" class="img-fluid" style="max-width: 80px;">
                                            @endif
                                        </div>
                                        <!-- Contenido (título y descripción) -->
                                        <div class="text-left">
                                            <h5 class="hand-cursor">
                                                {{ $tarea->titulo }}
                                                @if ($tarea->tipo === 'archivo')
                                                <!-- Icono de descarga al lado del título -->
                                                <img src="{{ asset('img/iconos/descargar.png') }}" alt="Descargar" class="img-fluid" style="max-width: 25px; margin-left: 5px;">
                                                @endif
                                            </h5>
                                            <p class="mb-0">{{ $tarea->descripcion }}</p>
                                        </div>
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
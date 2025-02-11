@extends('layouts.app')
@section('content')

<div class="container">
    <!-- Botón para volver -->
    <div class="row mb-3 mt-5">
        <div class="col-12 text-left">
            <a href="{{ route('cursos') }}">
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

    <h2 class='text-center mb-3'>{{ $curso->nombre }} - Tareas</h2>


    <div class="row mb-3">
        <div class="col-12 text-center">
            <a href="{{ route('tarea.create', ['curso_id' => $curso->id]) }}" class="btn boton">Añadir contenido</a>
        </div>
    </div>

    <div class="row contenido-cursos">
        <div class="col-12">
            @if ($curso->tareas->count() > 0)
            <div class='contenedor-cursos mw-md-60'>
                <div class="row justify-content-center .contenido-cursos">

                    <!-- Asignar clase dinámica según el tipo de tarea -->
                    

                    @foreach ($curso->tareas as $tarea)
                    @php
                    $borderClass = '';
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

                        <!-- Parte izquierda: Nombre del curso -->
                        <div class="curso-nombre pe-1">
                            @if($tarea->tipo == 'link')
                            <a href="{{ route('tarea.ver', ['curso_id' => $curso->id, 'tarea_id' => $tarea->id]) }} "
                                target="_blank">
                                <h6 class='hand-cursor'>{{ $tarea->titulo }}</h6>
                            </a>
                            @elseif($tarea->tipo == 'archivo')
                            <a href="{{ asset('storage/' . $tarea->recursoMultimedia->url) }}" download target="_blank">
                                <h6 class='hand-cursor'>{{ $tarea->titulo }}</h6>
                            </a>
                            @else
                            <a href="{{ route('tarea.ver', ['curso_id' => $curso->id, 'tarea_id' => $tarea->id]) }} ">
                                <h6 class='hand-cursor'>{{ $tarea->titulo }}</h6>
                            </a>
                            @endif

                            <p>{{$tarea->descripcion}}</p>
                        </div>

                        <!-- Parte derecha: Acciones (editar y eliminar) -->
                        <div class="curso-acciones d-flex flex-column gap-2 ">
                            <!-- Enlace de editar -->
                            <div class="accion-editar">
                                <!-- <a href="{{ route('cursos.edit', $curso->id) }}" class="btn btn-sm "> -->
                                @if($tarea->tipo !== 'test')
                                <a href="{{ route('tareas.edit.recurso', ['id' => $tarea->id]) }}" class="btn btn-sm">
                                    <img src="/img/iconos/editar.png" alt="Editar">
                                </a>
                                @endif
                            </div>

                            <!-- Enlace de eliminar -->
                            <div class="accion-eliminar">
                                <form
                                    action="{{ route('tarea.eliminar',['curso_id' => $tarea->curso_id, 'tarea_id' => $tarea->id]) }}"
                                    method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm"
                                        onclick="return confirm('¿Estás seguro de eliminar esta tarea?')">
                                        <img src="/img/iconos/eliminar.png" alt="">
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @else
            <p class='text-center'>No hay tareas para este curso.</p>
            @endif
        </div>
    </div>
</div>
@endsection
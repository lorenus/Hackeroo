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


    <!-- MENSAJE DE TODO OK O TODO MAL -->
    @if (session('status') || session('error'))
    @php
    $message = session('status') ?: session('error');
    $statusType = session('status') ? 'success' : 'error';
    @endphp

    <div class="d-flex justify-content-center">
        <div class="alert alert-{{ $statusType }} d-flex align-items-center w-auto mx-3" role="alert" style="max-width: 500px;">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="{{ ucfirst($statusType) }}:">
                <use xlink:href="#{{ $statusType === 'success' ? 'check-circle-fill' : 'exclamation-triangle-fill' }}" />
            </svg>
            <div>
                {{ $message }}
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    @endif



    
    <h2 class='text-center mb-3'>{{ $curso->nombre }}</h2>


    <div class="row mb-3">
        <div class="col-12 text-center">
            <a href="{{ route('tarea.create', ['curso_id' => $curso->id]) }}" class="btn boton">Añadir contenido</a>
        </div>
    </div>

    <h5 class='text-center'>Tareas del curso</h5>
    <div class="row contenido-cursos">
        <div class="col-12">
            @if ($curso->tareas->count() > 0)
            <div class='contenedor-cursos mw-md-60'>
                <div class="row justify-content-center">

                    @foreach ($curso->tareas as $tarea)

                    <div class="curso-item col-md-5 me-3 mb-3">

                        <!-- Parte izquierda: Nombre del curso -->
                        <div class="curso-nombre">
                            <a href="{{ route('tarea.ver', ['curso_id' => $curso->id, 'tarea_id' => $tarea->id]) }}">
                                <h6>{{ $tarea->titulo }}</h6>
                            </a>
                            <p>{{$tarea->descripcion}}</p>
                        </div>

                        <!-- Parte derecha: Acciones (editar y eliminar) -->
                        <div class="curso-acciones d-flex flex-column gap-2">
                            <!-- Enlace de editar -->
                            <div class="accion-editar">
                                <!-- <a href="{{ route('cursos.edit', $curso->id) }}" class="btn btn-sm "> -->
                                @if($tarea->tipo!=='test')
                                <a href="#" class="btn btn-sm ">
                                    <img src="/img/iconos/editar.png" alt="">
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
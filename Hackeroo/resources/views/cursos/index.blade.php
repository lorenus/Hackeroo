@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Botón para volver -->
    <div class="row mb-3 mt-5">
        <div class="col-12 text-left">
            <a href="{{ route('perfil') }}">
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

   




























































































































































































































































































































































































































































































    <!-- Botón para crear nuevo curso -->
    <div class="row mb-3">
        <div class="col-12 text-center">
            <a href="{{ route('cursos.create.step1') }}" class="btn boton">Crear Curso</a>
        </div>
    </div>

    <!-- Mensaje o contenido de los cursos -->
    <div class="row contenido-cursos ">
        <div class="col-12">
            @if($cursos->isEmpty())
            <p class="text-center">No tienes cursos creados aún.</p>
            @else

            <div class="contenedor-cursos mw-md-60">
                <div class="row justify-content-center gap-2">
                    @foreach($cursos as $curso)
                    <div class="curso-item col-md-5 mb-3">

                        <!-- Parte izquierda: Nombre del curso -->
                        <div class="curso-nombre">
                            <a href="{{ route('cursos.show', ['id' => $curso->id]) }}" >
                                <h5 class='hand-cursor'>{{ $curso->nombre }}</h5>
                            </a>
                            <p>{{$curso->descripcion}}</p>
                        </div>

                        <!-- Parte derecha: Acciones (editar y eliminar) -->
                        <div class="curso-acciones d-flex flex-column gap-2">
                            <!-- Enlace de editar -->
                            <div class="accion-editar ">
                                <a href="{{ route('cursos.edit', $curso->id) }}" class="btn btn-sm hand-cursor">
                                    <img src="/img/iconos/editar.png" alt="">
                                </a>
                            </div>

                            <!-- Enlace de eliminar -->
                            <div class="accion-eliminar">
                                <form action="{{ route('cursos.destroy', $curso->id) }}" method="POST" class='hand-cursor' style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm hand-cursor" onclick="return confirm('¿Estás seguro de eliminar este curso?')">
                                        <img src="/img/iconos/eliminar.png" alt="" class='hand-cursor'>
                                    </button>
                                </form>
                            </div>
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
@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Botón para volver -->
    <div class="row mb-3">
        <div class="col-12 text-left">
            <a href="{{ route('perfil') }}">
                <img src="/img/botones/volver.png" alt="Volver">
            </a>
        </div>
    </div>

    <!-- Título centrado -->
    <div class="row mb-3">
        <div class="col-12 text-center">
            <h2>Mis Cursos</h2>
        </div>
    </div>

    <!-- Botón para crear nuevo curso -->
    <div class="row mb-3">
        <div class="col-12 text-center">
            <a href="{{ route('cursos.create.step1') }}" class="btn boton">Crear Curso</a>
        </div>
    </div>

    <!-- Mensaje o contenido de los cursos -->
    <div class="row contenido-cursos">
        <div class="col-12">
            @if($cursos->isEmpty())
            <p class="text-center">No tienes cursos creados aún.</p>
            @else

            <div class="contenedor-cursos mw-md-60">
                <div class="row justify-content-center">
                    @foreach($cursos as $curso)
                    <div class="curso-item col-md-5 me-3 mb-3 p-3">

                        <!-- Parte izquierda: Nombre del curso -->
                        <div class="curso-nombre">
                        <a href="{{ route('cursos.show', ['id' => $curso->id]) }}">   <h5>{{ $curso->nombre }}</h5></a>
                            <p>{{$curso->descripcion}}</p>
                        </div>

                        <!-- Parte derecha: Acciones (editar y eliminar) -->
                        <div class="curso-acciones d-flex flex-column gap-2">
                            <!-- Enlace de editar -->
                            <div class="accion-editar">
                                <a href="{{ route('cursos.edit', $curso->id) }}" class="btn btn-sm ">
                                    <img src="/img/iconos/editar.png" alt="">
                                </a>
                            </div>

                            <!-- Enlace de eliminar -->
                            <div class="accion-eliminar">
                                <form action="{{ route('cursos.destroy', $curso->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm" onclick="return confirm('¿Estás seguro de eliminar este curso?')">
                                        <img src="/img/iconos/eliminar.png" alt="">
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

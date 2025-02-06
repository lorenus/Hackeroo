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

    <!-- Mensaje o contenido de los cursos -->
    <div class="row contenido-cursos">
        <div class="col-12">
            @if($cursos->isEmpty())
            <p class="text-center">No estás inscrito en ningún curso.</p>
            @else
            <div class="contenedor-cursos mw-md-60">
                <div class="row justify-content-center">
                    @foreach($cursos as $curso)
                    <div class="curso-item col-md-5 mb-3 p-3">
                        <!-- Enlace al curso -->
                        <a href="{{ route('tareas.show', $curso->id) }}" class="text-decoration-none text-dark">
                            <div class="curso-nombre">
                                <h5 class="text-center">{{ $curso->nombre }}</h5>
                                <p>{{ $curso->descripcion }}</p>
                            </div>
                            </a>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
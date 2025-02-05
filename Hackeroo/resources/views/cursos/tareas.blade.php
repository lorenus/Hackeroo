@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-3">
        <div class="col-12 text-left">
            <a href="{{ route('perfil') }}">
                <img src="/img/botones/volver.png" alt="Volver">
            </a>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-12 text-center">
            <h2>Tareas del curso: {{ $curso->nombre }}</h2>
        </div>
    </div>

    <div class="row">
        @foreach($curso->tareas as $tarea)
            <div class="col-md-4">
                <a href="{{ route('tarea.ver', ['curso_id' => $curso->id, 'tarea_id' => $tarea->id]) }}" class="text-decoration-none text-dark">
                    <div class="tarea-card">
                        <h5>{{ $tarea->titulo }}</h5>
                        <p>{{ $tarea->descripcion }}</p>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>
@endsection

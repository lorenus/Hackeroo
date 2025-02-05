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
            <h2>{{ $tarea->titulo }}</h2>
            <p>{{ $tarea->descripcion }}</p>
        </div>
    </div>

    <!-- Lista de Preguntas -->
    <div class="row">
        <div class="col-12">
            <h3 class="text-center">Preguntas</h3>
            @foreach($tarea->preguntas as $pregunta)
                <div class="mb-3">
                    <p><strong>{{ $pregunta->enunciado }}</strong></p>
                    <form action="{{ route('tarea.responder', ['curso_id' => $curso->id, 'tarea_id' => $tarea->id]) }}" method="POST">
                        @csrf
                        @foreach($pregunta->opciones_respuestas as $opcion)
                            <div>
                                <input type="radio" name="respuesta[{{ $pregunta->id }}]" value="{{ $opcion->id }}">
                                <label>{{ $opcion->respuesta }}</label>
                            </div>
                        @endforeach
                        <button type="submit" class="btn btn-primary mt-2">Responder</button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

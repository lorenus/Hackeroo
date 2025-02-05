@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-3">
        <div class="col-12 text-left">
            <a href="{{ route('curso.tareas', $curso_id) }}">
                <img src="/img/botones/volver.png" alt="Volver">
            </a>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-12 text-center">
            <h2>Responde las preguntas de la tarea: {{ $tarea->titulo }}</h2>
        </div>
    </div>

    <form action="{{ route('tarea.enviar', ['curso_id' => $curso_id, 'tarea_id' => $tarea->id]) }}" method="POST">
        @csrf

        @foreach($tarea->preguntas as $pregunta)
        <div class="pregunta">
            <h5>{{ $pregunta->enunciado }}</h5>

            @foreach($pregunta->opciones_respuestas as $opcion)
            <div class="form-check">
                <input type="radio" class="form-check-input" name="pregunta[{{ $pregunta->id }}]" value="{{ $opcion->id }}" id="opcion_{{ $opcion->id }}">
                <label class="form-check-label" for="opcion_{{ $opcion->id }}">{{ $opcion->respuesta }}</label>
            </div>
            @endforeach
        </div>
        @endforeach

        <button type="submit" class="btn btn-primary">Enviar respuestas</button>
    </form>

</div>
@endsection
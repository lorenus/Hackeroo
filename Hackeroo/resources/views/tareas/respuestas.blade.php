@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Respuestas de los alumnos - {{ $tarea->titulo }}</h2>
    <a href="{{ route('cursos.show', ['id' => $tarea->curso_id]) }}" class="btn btn-secondary mb-3">Volver</a>

    @foreach ($tarea->preguntas as $pregunta)
    <div class="card mb-3">
        <div class="card-header">
            <strong>Pregunta:</strong> {{ $pregunta->enunciado }}
        </div>
        <div class="card-body">
            <ul class="list-group">
                @foreach ($pregunta->respuestas_alumnos as $respuesta)
                <li class="list-group-item">
                    <strong>Alumno:</strong> {{ $respuesta->usuario?->nombre ?? 'Desconocido' }} ({{ $respuesta->usuario?->DNI ?? 'N/A' }})<br>
                    <strong>Respuesta:</strong> {{ $respuesta->opcion_respuesta?->respuesta ?? 'Sin respuesta' }}<br>

                        <strong>Estado:</strong>
                        @if ($respuesta->opcion_respuesta?->es_correcta)
                        <span class="text-success">Correcta</span>
                        @else
                        <span class="text-danger">Incorrecta</span>
                        @endif
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    @endforeach
</div>
@endsection
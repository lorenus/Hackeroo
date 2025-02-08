@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Botón para volver -->
    <div class="row mb-3">
        <div class="col-12 text-left">
            <a href="{{ route('curso.tareas', $curso->id) }}">
                <img src="/img/botones/volver.png" alt="Volver">
            </a>
        </div>
    </div>

    <!-- Título y resumen del resultado -->
    <div class="row mb-3">
        <div class="col-12 text-center">
            <h2>Resultado de la tarea: {{ $tarea->titulo }}</h2>
            <p><strong>Nota final:</strong> {{ number_format($puntuacion, 2) }}/10</p>
            <p>Has respondido correctamente {{ $aciertos }} de {{ $total_preguntas }} preguntas.</p>
        </div>
    </div>

    <!-- Resultados detallados -->
    <div class="row">
        @foreach ($resultados as $resultado)
        <div class="col-12 mb-3 border rounded p-3">
            <h5>{{ $resultado['pregunta'] }}</h5>
            <p><strong>Tu respuesta:</strong> {{ $resultado['respuesta_usuario'] }}</p>
            @if ($resultado['resultado'] === 'Correcta')
                <p class="text-success"><strong>¡Respuesta correcta!</strong></p>
            @elseif ($resultado['resultado'] === 'Incorrecta')
                <p class="text-danger"><strong>¡Respuesta incorrecta!</strong></p>
            @else
                <p class="text-secondary"><strong>No has respondido esta pregunta.</strong></p>
            @endif
        </div>
        @endforeach
    </div>
</div>
@endsection
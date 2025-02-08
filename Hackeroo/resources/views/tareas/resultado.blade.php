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
    <!-- Contenedor para centrar el fieldset -->
    <div class="d-flex justify-content-center">
        <fieldset class="mt-0">
            <div class="row">
                <div class="tabla-scroll-container">
                    <table class="ver-tareas-alumnos">
                        @foreach ($resultados as $resultado)
                        <tr>
                            <td>
                                <div class="col-12 mb-3 pregunta">
                                    <h5>{{ $loop->iteration }}. {{ $resultado['pregunta'] }}</h5>
                                    <p><strong>Tu respuesta:</strong> {{ $resultado['respuesta_usuario'] }}</p>
                                    @if ($resultado['resultado'] === 'Correcta')
                                    <p class="text-success"><strong>¡Respuesta correcta!</strong></p>
                                    @elseif ($resultado['resultado'] === 'Incorrecta')
                                    <p class="text-danger"><strong>¡Respuesta incorrecta!</strong></p>
                                    <!-- Mostrar la respuesta correcta -->
                                    @php
                                    // Obtener la pregunta correspondiente
                                    $pregunta = $tarea->preguntas->firstWhere('enunciado', $resultado['pregunta']);
                                    // Obtener la respuesta correcta
                                    $respuesta_correcta = $pregunta->opciones_respuestas->firstWhere('es_correcta', true);
                                    @endphp
                                    @if ($respuesta_correcta)
                                    <p class="text-center"><strong>Respuesta correcta:</strong> {{ $respuesta_correcta->respuesta }}</p>
                                    @endif
                                    @else
                                    <p class="text-secondary"><strong>No has respondido esta pregunta.</strong></p>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </fieldset>
    </div>
</div>

@endsection
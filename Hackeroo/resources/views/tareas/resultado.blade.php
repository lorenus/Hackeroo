@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-3">
        <div class="col-12 text-left">
            <a href="{{ route('curso.tareas', $curso->id) }}">
                <img src="/img/botones/volver.png" alt="Volver">
            </a>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-12 text-center">
            <h2>Resultado:</h2>
            <p>Tarea: {{ $tarea->titulo }}</p>
            <p>{{ $aciertos }}/{{ $total }}</p>
        </div>
    </div>

    <!-- Contenedor para centrar el fieldset -->
    <div class="d-flex justify-content-center">
        <fieldset class="mt-0">
            <div class="row">
                <div class="tabla-scroll-container">
                    <table class="ver-tareas-alumnos">
                        @foreach($tarea->preguntas as $pregunta)
                        <tr>
                            <td>
                                <div class="pregunta">
                                    <h5>{{ $loop->iteration }}. {{ $pregunta->enunciado }}</h5>

                                    @foreach($pregunta->opciones_respuestas as $opcion)
                                    <div class="align-items-start text-left">
                                        @foreach($resultados as $resultado)
                                        @if ($resultado['pregunta'] == $pregunta->enunciado)
                                        <div class="col-12 mb-3">
                                            <input type="radio"
                                                class="form-check-input"
                                                name="pregunta[{{ $pregunta->id }}]"
                                                value="{{ $opcion->id }}"
                                                id="opcion_{{ $opcion->id }}"
                                                @if ($opcion->respuesta == $resultado['respuesta_usuario']) checked disabled @endif
                                            style="pointer-events: none; opacity: 1;" />
                                            &nbsp;&nbsp;
                                            <label for="opcion_{{ $opcion->id }}"
                                                class="form-check-label {{ 
            $opcion->es_correcta ? 'text-success' : 
            ($opcion->respuesta == $resultado['respuesta_usuario'] && !$opcion->es_correcta ? 'text-danger' : '') 
        }}">
                                                {{ $opcion->respuesta }}
                                            </label>
                                        </div>
                                        @endif
                                        @endforeach <!--foreach resultado-->
                                    </div>
                                    @endforeach

                                    <!-- Mostrar la respuesta correcta si el usuario falló -->
                                    @foreach($resultados as $resultado)
                                    @if ($resultado['pregunta'] == $pregunta->enunciado && !$resultado['acertada'])
                                    <div class="col-12 mt-2">
                                        <!-- <p class="text-center text-danger">¡Respuesta incorrecta!</p> -->
                                        <p class="text-center">Respuesta correcta:
                                            @foreach($pregunta->opciones_respuestas as $opcion)
                                            @if ($opcion->es_correcta)
                                            {{ $opcion->respuesta }}
                                            @endif
                                            @endforeach
                                        </p>
                                    </div>
                                    @endif
                                    @endforeach
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
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

    <!-- <fieldset class="tabla-tarea"> -->
    <div class="row">
        <div class="tabla-scroll-container tabla-scroll-container-tarea">
            <table class="ver-tareas-alumnos">
                @foreach($tarea->preguntas as $pregunta)
                <tr>
                    <td>
                        <div class="pregunta">
                            <h5>{{ $loop->iteration }}. {{ $pregunta->enunciado }}</h5>

                            @foreach($pregunta->opciones_respuestas as $opcion)
                            <div class="align-items-start text-left">
                                @foreach($resultados as $resultado) 
                                @if ($resultado['pregunta'] == $pregunta->enunciado)<!--se puede hacer con foreing keys?-->
                                <div class="col-12 mb-3">
                                    <input type="radio"
                                        class="form-check-input"
                                        name="pregunta[{{ $pregunta->id }}]"
                                        value="{{ $opcion->id }}"
                                        id="opcion_{{ $opcion->id }}"
                                        @if ($opcion->respuesta == $resultado['respuesta_usuario']) checked disabled @endif />
                                    &nbsp;&nbsp;
                                    @if(!$resultado['acertada'])
                                    <label class="form-check-label text-danger" for="opcion_{{ $opcion->id }}">{{ $opcion->respuesta }}</label>
                                    @else
                                    <label class="form-check-label text-success" for="opcion_{{ $opcion->id }}">{{ $opcion->respuesta }}</label>
                                    @endif
                                </div>
                                @endif
                                @endforeach <!--foreach resultado-->
                            </div>
                            @endforeach
                        </div>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
    <!-- </fieldset> -->
</div>
@endsection

<?php /*
<!-- @if(!$resultado['acertada'])
<p class="text-danger">¡Respuesta incorrecta!</p>
<p>Respuesta correcta: {{ $resultado['respuesta_correcta_texto'] }}</p>
@else
<p class="text-success">¡Respuesta correcta!</p>
<p>Respuesta correcta: {{ $resultado['respuesta_correcta_texto'] }}</p>
@endif -->
*/
?>
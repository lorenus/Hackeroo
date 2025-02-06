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

    <form action="{{ route('tarea.enviar', ['curso_id' => $curso_id, 'tarea_id' => $tarea->id]) }}" method="POST">
        @csrf
        <fieldset class="tabla-tarea">
            <legend>
                    <div class="col-12 text-center">
                        <h2>{{ $tarea->titulo }}</h2>
                        <!-- <p>{{ $tarea->descripcion }}</p> -->
                    </div>
            </legend>
            <div class="tabla-scroll-container tabla-scroll-container-tarea">
                <table class="ver-tareas-alumnos">
                    @foreach($tarea->preguntas as $pregunta)
                    <tr>
                        <td>
                            <div class="pregunta">

                                <h5>{{ $loop->iteration }}. {{ $pregunta->enunciado }}</h5>

                                @foreach($pregunta->opciones_respuestas as $opcion)
                                <div class="align-items-start text-left">
                                    
                                    <input type="radio" class="form-check-input" name="pregunta[{{ $pregunta->id }}]" value="{{ $opcion->id }}" id="opcion_{{ $opcion->id }}">
                                    &nbsp;&nbsp;
                                    <label class="form-check-label" for="opcion_{{ $opcion->id }}">{{ $opcion->respuesta }}</label>
                                </div>

                                @endforeach
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </table>
                <div class="text-center mt-4">
                <x-primary-button type="submit" class="btn btn-primary">Enviar respuestas</x-primary-button>
                </div>
            </div>
        </fieldset>
    </form>

</div>
@endsection
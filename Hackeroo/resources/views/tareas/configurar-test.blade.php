@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Botón para volver -->
    <div class="row mb-3 volver">
        <div class="col-12 text-left">
            <a href="{{ route('cursos.show', ['id'=>$tarea->curso_id]) }}">
                <img src="/img/botones/volver.png" alt="Volver">
            </a>
        </div>
    </div>

    <h2 class='text-center'>Crear test</h2>
    <div class='contenedor-cursos'>
    <form action="{{ route('tarea.test.guardar', ['curso_id' => $tarea->curso_id, 'tarea_id' => $tarea->id]) }}"
        method="POST">
        @csrf

        @for ($i = 1; $i <= $numero_preguntas; $i++) <div class="form-group mb-5">
            <h4>Pregunta {{ $i}}</h4>
            <div class="form-group d-flex align-items-center mb-2">

                <label class='text-nowrap me-2' for="pregunta{{ $i }}">Enunciado:</label>
                <x-text-input id="pregunta{{ $i }}" class="form-control block mb-3" type="text"
                    name="preguntas[{{ $i }}][enunciado]" required />
            </div>
            <h4>Respuestas</h4>
            @for ($j = 1; $j <= 4; $j++) <div class="form-group d-flex align-items-center mb-2">
                <label class='text-nowrap me-2' for="opcion{{ $i }}{{ $j }}">Opción {{ $j }}:</label>
                <x-text-input id="opcion{{ $i }}{{ $j }}" class="form-control me-2" type="text"
                    name="preguntas[{{ $i }}][opciones][{{ $j }}][respuesta]" required />

                <div class="form-check">
                    <input type="radio" class="form-check-input" name="preguntas[{{ $i }}][respuesta_correcta]"
                        value="{{ $j }}" required>
                    <label class="form-check-label" for="opcion{{ $i }}{{ $j }}">Correcta</label>
                </div>
</div>
@endfor
</div>
@endfor
<div class="col-12 mt-3 text-center mt-4">
    <x-primary-button type="submit" class="btn btn-primary">Guardar</x-primary-button>
</div>


</form>
</div>
</div>
@endsection
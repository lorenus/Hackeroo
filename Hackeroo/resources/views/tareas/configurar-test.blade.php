@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Configurar Test</h1>
    <form action="{{ route('tarea.test.guardar', ['curso_id' => $tarea->curso_id]) }}" method="POST">
        @csrf

        @for ($i = 1; $i <= $numero_preguntas; $i++)
            <div class="form-group">
                <label for="pregunta{{ $i }}">Pregunta {{ $i }}</label>
                <input type="text" class="form-control form-control-sm" id="pregunta{{ $i }}" name="preguntas[{{ $i }}][enunciado]" required>
                
                @for ($j = 1; $j <= 4; $j++)
                    <div class="form-group d-flex align-items-center mb-2">
                        <input type="text" class="form-control form-control-sm me-2" id="opcion{{ $i }}{{ $j }}" name="preguntas[{{ $i }}][opciones][{{ $j }}][respuesta]" required>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" name="preguntas[{{ $i }}][respuesta_correcta]" value="{{ $j }}" required>
                            <label class="form-check-label" for="opcion{{ $i }}{{ $j }}">Correcta</label>
                        </div>
                    </div>
                @endfor
            </div>
        @endfor

        <button type="submit" class="btn btn-primary">Guardar Test</button>
    </form>
</div>
@endsection

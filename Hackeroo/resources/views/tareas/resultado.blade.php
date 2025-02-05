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
            <h2>Resultado de la tarea: {{ $tarea->titulo }}</h2>
            <p>Has acertado {{ $aciertos }} de {{ $total }} preguntas.</p>
        </div>
    </div>

    <div class="row">
        @foreach($resultados as $resultado)
            <div class="col-12 mb-3">
                <h5>{{ $resultado['pregunta'] }}</h5>
                <p><strong>Tu respuesta:</strong> {{ $resultado['respuesta_usuario'] }}</p>
                @if(!$resultado['acertada'])
                    <p class="text-danger">¡Respuesta incorrecta!</p>
                @else
                    <p class="text-success">¡Respuesta correcta!</p>
                @endif
            </div>
        @endforeach
    </div>
</div>
@endsection

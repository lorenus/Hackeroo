@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center">Resultados del Test</h2>

    <p><strong>Aciertos:</strong> {{ $aciertos }}</p>
    <p><strong>Errores:</strong> {{ $errores }}</p>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Pregunta</th>
                <th>Tu Respuesta</th>
                <th>Respuesta Correcta</th>
                <th>Resultado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($resultados as $resultado)
                <tr>
                    <td>{{ $resultado['pregunta'] }}</td>
                    <td>{{ $resultado['respuesta_usuario'] }}</td>
                    <td>{{ $resultado['correcta'] }}</td>
                    <td>
                        @if ($resultado['es_correcta'])
                            ✅ Correcto
                        @else
                            ❌ Incorrecto
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('cursos.show', ['id' => $curso->id]) }}" class="btn btn-primary">Volver al Curso</a>
</div>
@endsection

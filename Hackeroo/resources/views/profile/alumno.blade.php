@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalle del Alumno</h1>

    @if($alumno)
        <p><strong>Nombre:</strong> {{ $alumno->nombre }} {{ $alumno->apellidos }}</p>
        <p><strong>Curso:</strong> {{ $alumno->curso }}</p>
        @else
        <p>No se encontró el alumno.</p>
    @endif

    <a href="{{ route('alumnos') }}">Volver a la lista de alumnos</a>
</div>
@endsection
<!-- resources/views/profile/alumnos.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Alumnos de tus cursos</h1>
    
    @if(count($alumnos) > 0)
        <ul>
            @foreach($alumnos as $alumno)
                <li>{{ $alumno->nombre }} {{ $alumno->apellidos }}</li>
            @endforeach
        </ul>
    @else
        <p>No tienes alumnos asociados a tus cursos.</p>
    @endif
</div>
@endsection

<!-- resources/views/cursos/index_alumno.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Mis Cursos</h1>
        
        @if($cursos->isEmpty())
            <p>No estás inscrito en ningún curso.</p>
        @else
            <ul>
                @foreach($cursos as $curso)
                    <li>{{ $curso->nombre }} - {{ $curso->descripcion }}</li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection

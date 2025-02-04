@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $curso->nombre }}</h1>
    <p>{{ $curso->descripcion }}</p>

    <h2>Tareas del curso</h2>
    @if ($curso->tareas->count() > 0)
        <ul>
            @foreach ($curso->tareas as $tarea)
                <li>
                    <strong>{{ $tarea->titulo }}</strong>
                    <p>{{ $tarea->descripcion }}</p>
                   
                </li>
            @endforeach
        </ul>
    @else
        <p>No hay tareas para este curso.</p>
    @endif
</div>
@endsection
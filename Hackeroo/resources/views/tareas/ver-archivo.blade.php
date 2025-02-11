@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ $tarea->titulo }}</h2>
    <p>{{ $tarea->descripcion }}</p>

    @if($recurso)
        <a href="{{ asset('storage/' . $recurso->url) }}" class="btn btn-primary" download>Descargar Archivo</a>
    @else
        <p>No se encontró el archivo.</p>
    @endif
</div>
@endsection

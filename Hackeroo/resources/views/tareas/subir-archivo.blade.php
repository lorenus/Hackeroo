@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Subir Archivo para la Tarea: {{ $tarea->titulo }}</h1>
    <form action="{{ route('tarea.archivo.guardar', ['curso_id' => $tarea->curso_id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="archivo">Archivo</label>
            <input type="file" class="form-control" id="archivo" name="archivo" required>
        </div>
        <input type="hidden" name="curso_id" value="{{ $tarea->curso_id }}">
        <button type="submit" class="btn btn-primary">Subir Archivo</button>
    </form>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Agregar Link</h1>
    <form action="{{ route('tarea.link.guardar', ['id' => $tarea->id]) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="url">URL del Recurso</label>
            <input type="url" class="form-control" id="url" name="url" required>
        </div>
        <button type="submit" class="btn btn-primary">Agregar Link</button>
    </form>
</div>
@endsection
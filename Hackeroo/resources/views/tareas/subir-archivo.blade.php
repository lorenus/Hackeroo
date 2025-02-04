@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Subir Archivo</h1>
    <form action="{{ route('tarea.archivo.guardar', ['id' => $tarea->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="archivo">Selecciona un archivo</label>
            <input type="file" class="form-control-file" id="archivo" name="archivo" required>
        </div>
        <button type="submit" class="btn btn-primary">Subir Archivo</button>
    </form>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar tarea</h2>

    <!-- Agregar una clase para ocultar elementos -->
    <style>
        .hidden {
            display: none;
        }
    </style>

    <form action="{{ route('tareas.update.recurso', $tarea->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Tipo -->
        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo de recurso:</label>
            <select name="tipo" id="tipo" class="form-select" required>
                <option value="archivo" {{ $tarea->recursoMultimedia->tipo === 'archivo' ? 'selected' : '' }}>Archivo</option>
                <option value="link" {{ $tarea->recursoMultimedia->tipo === 'link' ? 'selected' : '' }}>Enlace</option>
            </select>
        </div>

        <!-- Campo para archivo -->
        <div id="archivo-container" class="mb-3 {{ $tarea->recursoMultimedia->tipo === 'archivo' ? '' : 'hidden' }}">
            <label for="archivo" class="form-label">Archivo:</label>
            <input type="file" name="archivo" id="archivo" class="form-control">
            @if ($tarea->recursoMultimedia->tipo === 'archivo')
                <p class="text-muted mt-2">Archivo actual: <a href="{{ Storage::url($tarea->recursoMultimedia->url) }}" target="_blank">{{ basename($tarea->recursoMultimedia->url) }}</a></p>
            @endif
        </div>

        <!-- Campo para enlace -->
        <div id="link-container" class="mb-3 {{ $tarea->recursoMultimedia->tipo === 'link' ? '' : 'hidden' }}">
            <label for="url" class="form-label">URL:</label>
            <input type="text" name="url" id="url" class="form-control" value="{{ $tarea->recursoMultimedia->tipo === 'link' ? $tarea->recursoMultimedia->url : '' }}">
        </div>

        <button type="submit" class="btn btn-primary">Guardar cambios</button>
    </form>
</div>

<script>
    // Mostrar/ocultar campos según el tipo seleccionado
    document.getElementById('tipo').addEventListener('change', function () {
        const tipo = this.value;
        const archivoContainer = document.getElementById('archivo-container');
        const linkContainer = document.getElementById('link-container');

        if (tipo === 'archivo') {
            archivoContainer.classList.remove('hidden');
            linkContainer.classList.add('hidden');
        } else if (tipo === 'link') {
            archivoContainer.classList.add('hidden');
            linkContainer.classList.remove('hidden');
        }
    });
</script>
@endsection
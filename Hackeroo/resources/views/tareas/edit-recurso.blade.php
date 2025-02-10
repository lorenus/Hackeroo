@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Recurso Multimedia</h2>

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
        @php
            $archivoClass = $tarea->recursoMultimedia->tipo === 'archivo' ? '' : 'hidden';
        @endphp
        <div id="archivo-container" class="mb-3 {{ $archivoClass }}">
            <label for="archivo" class="form-label">Archivo:</label>
            <input type="file" name="archivo" id="archivo" class="form-control">
        </div>

        <!-- Campo para enlace -->
        @php
            $linkClass = $tarea->recursoMultimedia->tipo === 'link' ? '' : 'hidden';
        @endphp
        <div id="link-container" class="mb-3 {{ $linkClass }}">
            <label for="url" class="form-label">URL:</label>
            <input type="text" name="url" id="url" class="form-control" value="{{ $tarea->recursoMultimedia->url }}">
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
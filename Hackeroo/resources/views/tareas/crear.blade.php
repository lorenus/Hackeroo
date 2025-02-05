@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Nueva Tarea</h1>
    <form action="{{ route('tarea.guardar') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="tipo">Tipo de Tarea</label>
        <select class="form-control" id="tipo" name="tipo" required>
            <option value="test">Test</option>
            <option value="archivo">Archivo</option>
            <option value="link">Link</option>
        </select>
    </div>

    <div class="form-group" id="numero_preguntas_container" style="display: block;">
        <label for="numero_preguntas">Número de Preguntas</label>
        <input type="number" class="form-control" id="numero_preguntas" name="numero_preguntas" min="1" value="5">
    </div>

    <!-- Campo para el título de la tarea -->
    <div class="form-group">
        <label for="titulo">Título</label>
        <input type="text" class="form-control" id="titulo" name="titulo" required>
    </div>

    <!-- Campo para la descripción de la tarea -->
    <div class="form-group">
        <label for="descripcion">Descripción</label>
        <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
    </div>

    <!-- Campo para el archivo (solo visible si el tipo es 'archivo') -->
    <div class="form-group" id="archivo_container" style="display: none;">
        <label for="archivo">Selecciona un Archivo</label>
        <input type="file" class="form-control" id="archivo" name="archivo" accept=".pdf,.doc,.docx,.ppt,.pptx">
    </div>

    <!-- Campo para el enlace (solo visible si el tipo es 'link') -->
    <div class="form-group" id="link_container" style="display: none;">
        <label for="url">Enlace</label>
        <input type="url" class="form-control" id="url" name="url" placeholder="http://">
    </div>

    <input type="hidden" name="curso_id" value="{{ $curso_id }}">
    <button type="submit" class="btn btn-primary">Siguiente</button>
</form>
</div>

<script>
    // Mostrar campos según el tipo de tarea seleccionado
    document.getElementById('tipo').addEventListener('change', function() {
        var tipo = this.value;
        var numeroPreguntasContainer = document.getElementById('numero_preguntas_container');
        var archivoContainer = document.getElementById('archivo_container');
        var linkContainer = document.getElementById('link_container');

        // Mostrar el campo para número de preguntas solo si es un test
        if (tipo === 'test') {
            numeroPreguntasContainer.style.display = 'block';
            archivoContainer.style.display = 'none';
            linkContainer.style.display = 'none';
        } 
        // Mostrar el campo para archivo solo si es archivo
        else if (tipo === 'archivo') {
            numeroPreguntasContainer.style.display = 'none';
            archivoContainer.style.display = 'block';
            linkContainer.style.display = 'none';
        } 
        // Mostrar el campo para link solo si es link
        else if (tipo === 'link') {
            numeroPreguntasContainer.style.display = 'none';
            archivoContainer.style.display = 'none';
            linkContainer.style.display = 'block';
        }
    });

    // Asegurarse de que si no se ingresa número de preguntas, se asigne 5
    document.querySelector('form').addEventListener('submit', function(event) {
        var numeroPreguntas = document.getElementById('numero_preguntas');
        // Si no se ha introducido un valor, poner el valor por defecto (5)
        if (numeroPreguntas.value === '') {
            numeroPreguntas.value = 5;
        }
    });
</script>
@endsection

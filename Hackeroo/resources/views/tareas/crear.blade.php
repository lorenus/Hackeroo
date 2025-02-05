@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Botón para volver -->
    <div class="row mb-3 volver">
        <div class="col-12 text-left">
            <a href="{{ route('cursos') }}">
                <img src="/img/botones/volver.png" alt="Volver">
            </a>
        </div>
    </div>

    <h2 class="text-center">Crear Nueva Tarea</h2>

    <form action="{{ route('tarea.guardar') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group" id="tipo" name="tipo" required>
            <div class="custom-select-container border">
                <label for="tipo">Tipo de Tarea</label>
                <x-select :options="['test' => 'Test', 'archivo' => 'Archivo', 'link' => 'Link']" selected="test" />
                <span class="custom-select-arrow">▼</span>
            </div>
        </div>

        <!-- <select class="form-control" id="tipo" name="tipo" required>
                <option value="test">Test</option>
                <option value="archivo">Archivo</option>
                <option value="link">Link</option>
            </select> -->


        <div class="form-group" id="numero_preguntas_container">
            <label for="numero_preguntas">Número de preguntas</label>
            <x-number-input class="form-control" id="numero_preguntas" name="numero_preguntas" max='25' />
        </div>

        <!-- Campo para el título de la tarea -->
        <div class="form-group mb-4">
            <label for="titulo">Título</label>
            <x-text-input id="nombre" class="form-control block" type="text" id="titulo" name="titulo" :value="old('nombre')" required />
        </div>

        <!-- Campo para la descripción de la tarea -->
        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <x-text-area class="form-control" id="descripcion" name="descripcion"></x-text-area>
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
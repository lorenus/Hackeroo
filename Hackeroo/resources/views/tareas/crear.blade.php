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

    <h2 class="text-center">Crear contenido</h2>

    <form action="{{ route('tarea.guardar') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row justify-content-center mb-3">
        <!-- Primer div: Tipo de tarea -->
        <div class="col-5 d-flex align-items-center border border-3 rounded border-warning p-2 me-3">
            <label for="tipo" class="me-2 text-nowrap">Tipo de contenido</label>
            <select class="form-select custom-select border-0" id="tipo" name="tipo" required>
                <option value="test">Test</option>
                <option value="archivo">Archivo</option>
                <option value="link">Link</option>
            </select>
        </div>

        <!-- Segundo div: Número de preguntas -->
        <div class="col-5 d-flex align-items-center border border-3 rounded border-warning p-2" id="numero_preguntas_container">
            <div class="form-group d-flex align-items-center">
                <label for="numero_preguntas" class="me-2 text-nowrap">Número de preguntas</label>
                <x-number-input class="form-control" id="numero_preguntas" name="numero_preguntas" max='25' />
            </div>
        </div>
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
        <x-file-input class="form-control" id="archivo" name="archivo" accept=".pdf,.doc,.docx,.ppt,.pptx" label="Selecciona un archivo:" />
    </div>

    <!-- Campo para el enlace (solo visible si el tipo es 'link') -->
    <div class="form-group" id="link_container" style="display: none;">
        <label for="url">Enlace</label>
        <x-text-input id="url" class="form-control" type="url" id="url" name="url" placeholder="http://" required />
    </div>

    <input type="hidden" name="curso_id" value="{{ $curso_id }}">
    <div class="col-12 mt-3 text-center mt-4">
        <x-primary-button type="submit" class="btn btn-primary">Siguiente</x-primary-button>
    </div>
</form>
</div>
@endsection
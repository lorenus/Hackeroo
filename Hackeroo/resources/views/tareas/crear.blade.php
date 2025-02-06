@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Boton volver -->
    <div class="row mb-3 volver">
        <div class="col-12 text-left">
            <a href="{{ route('cursos') }}">
                <img src="/img/botones/volver.png" alt="Volver">
            </a>
        </div>
    </div>


    <h2>Crear nuevo contenido</h2>
    <form action="{{ route('tarea.guardar') }}" method="POST" enctype="multipart/form-data">
        @csrf


        <div class="form-group">
            <div class="col-5 d-flex align-items-center border border-3 rounded border-warning p-2 me-3">
                <label for="tipo">Tipo de contenido</label>
                <select class="form-select custom-select border-0" id="tipo" name="tipo" required>
                    <option value="test">Test</option>
                    <option value="archivo">Archivo</option>
                    <option value="link">Link</option>
                </select>
            </div>
        </div>

        <div class="form-group" id="numero_preguntas_container" style="display: block;">
            <label for="numero_preguntas">Número de Preguntas</label>
            <input type="number" class="form-control" id="numero_preguntas" name="numero_preguntas" min="1" value="5">
        </div>

        <!-- Campo para el título de la tarea -->
        <div class="form-group mb-3">
            <label for="titulo">Título</label>
            <x-text-input class="form-control" id="titulo" name="titulo" required/>
        </div>

        <!-- Campo para la descripción de la tarea -->
        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <x-text-area class="form-control" id="descripcion" name="descripcion" rows="3" required/>
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
@endsection
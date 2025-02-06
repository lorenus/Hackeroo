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


    <h2 class='text-center'>Crear nuevo contenido</h2>
    <form action="{{ route('tarea.guardar') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row justify-content-center mb-3">
            <div class="form-group col-5">
                <div class=" d-flex align-items-center border border-3 rounded border-warning p-2 me-3">
                    <label for="tipo" class='text-nowrap'>Tipo de contenido</label>
                    <select class="form-select custom-select border-0 text-center" id="tipo" name="tipo" required>
                        <option value="test">Test</option>
                        <option value="archivo">Archivo</option>
                        <option value="link">Link</option>
                    </select>
                </div>
            </div>

            <div class="form-group col-5" id="numero_preguntas_container" >
                <div class="d-flex align-items-center border border-3 rounded border-warning p-2 me-3">
                    <label for="numero_preguntas" class='text-nowrap me-3'>Número de preguntas</label>
                    <x-number-input class="form-control" id="numero_preguntas" name="numero_preguntas" min='1' max='25' value='1' />
                </div>
            </div>
        </div>


        <!-- Campo para el título de la tarea -->
        <div class="form-group mb-3">
            <label for="titulo">Título</label>
            <x-text-input class="form-control" id="titulo" name="titulo" required />
        </div>

        <!-- Campo para la descripción de la tarea -->
        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <x-text-area class="form-control" id="descripcion" name="descripcion" rows="3" required />
        </div>

        <!-- Campo para el archivo (solo visible si el tipo es 'archivo') -->
        <div class="form-group" id="archivo_container" style="display: none;">
        <x-file-input class="form-control" id="archivo" name="archivo" accept=".pdf,.doc,.docx,.ppt,.pptx" label="Selecciona un archivo:" />

            <!-- <label for="archivo">Selecciona un Archivo</label>
            <input type="file" class="form-control" id="archivo" name="archivo" accept=".pdf,.doc,.docx,.ppt,.pptx"> -->
        </div>

        <!-- Campo para el enlace (solo visible si el tipo es 'link') -->
        <div class="form-group" id="link_container" style="display: none;">
            <label for="url">Enlace</label>
            <x-text-input id="url" class="form-control" type="url" id="url" name="url" placeholder="http://" required />
            <!-- <input type="url" class="form-control" id="url" name="url" placeholder="http://"> -->
        </div>
        <div class="col-12 mt-3 text-center mt-4">
            <input type="hidden" name="curso_id" value="{{ $curso_id }}">
            <x-primary-button type="submit" class="btn btn-primary">Continuar</x-primary-button>
        </div>
    </form>
</div>
@endsection
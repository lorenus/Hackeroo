@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class='text-center'>Añadir contenido</h2>
    <form action="{{ route('tarea.guardar') }}" method="POST">
        @csrf
        <div class="form-group mb-2">
            <div>
                <x-input-label for="tipo" value='Tipo de contenido' />
                <select class="form-control" id="tipo" name="tipo" required>
                    <option value="test">Test</option>
                    <option value="archivo">Archivo</option>
                    <option value="link">Link</option>
                </select>
            </div>
            <div class="form-group mb-2" id="numero_preguntas_container">
                <label for="numero_preguntas">Número de preguntas</label>
                <x-number-input class="form-control" id="numero_preguntas" name="numero_preguntas" required />
            </div>
        </div>
        <div class="form-group mb-4">
            <label for="titulo">Título</label>
            <x-text-input class="form-control" id="titulo" name="titulo" required />
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <x-text-area class="form-control" id="descripcion" name="descripcion" rows="3" required />
        </div>
        <input type="hidden" name="curso_id" value="{{ $curso_id }}">
        <x-primary-button type="submit" class="btn btn-primary">Siguiente</x-primary-button>
    </form>
</div>


<script>
document.getElementById('tipo').addEventListener('change', function() {
    var numeroPreguntasContainer = document.getElementById('numero_preguntas_container');
    if (this.value === 'test') {
        numeroPreguntasContainer.style.display = 'block';
    } else {
        numeroPreguntasContainer.style.display = 'none';
    }
});
</script>
@endsection
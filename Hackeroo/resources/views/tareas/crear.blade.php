@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Nueva Tarea</h1>
    <form action="{{ route('tarea.guardar') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="tipo">Tipo de Tarea</label>
            <select class="form-control" id="tipo" name="tipo" required>
                <option value="test">Test</option>
                <option value="archivo">Archivo</option>
                <option value="link">Link</option>
            </select>
        </div>
        <div class="form-group">
            <label for="numero_preguntas">Número de Preguntas (solo para test)</label>
            <input type="number" class="form-control" id="numero_preguntas" name="numero_preguntas" min="1" disabled>
        </div>
        <div class="form-group">
            <label for="titulo">Título</label>
            <input type="text" class="form-control" id="titulo" name="titulo" required>
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
        </div>
        <input type="hidden" name="curso_id" value="{{ $curso_id }}">
        <button type="submit" class="btn btn-primary">Siguiente</button>
    </form>
</div>

<script>
    document.getElementById('tipo').addEventListener('change', function() {
        var numeroPreguntas = document.getElementById('numero_preguntas');
        if (this.value === 'test') {
            numeroPreguntas.removeAttribute('disabled');
        } else {
            numeroPreguntas.setAttribute('disabled', 'disabled');
        }
    });
</script>
@endsection
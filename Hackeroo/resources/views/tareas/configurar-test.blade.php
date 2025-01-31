@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Crear Test</h2>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('tarea.test.store') }}">
        @csrf
        <div class="mb-3">
            <label for="titulo" class="form-label">Título de la tarea</label>
            <input type="text" class="form-control" name="titulo" required>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" name="descripcion" required></textarea>
        </div>

        <div class="mb-3">
            <label for="curso_id" class="form-label">Selecciona el curso</label>
            <select class="form-control" name="curso_id" required>
                @foreach(Auth::user()->cursos_profesor as $curso)
                    <option value="{{ $curso->id }}">{{ $curso->nombre }}</option>
                @endforeach
            </select>
        </div>

        <h4>Preguntas</h4>
        <div id="preguntas-container">
            <div class="pregunta">
                <label>Enunciado de la pregunta:</label>
                <input type="text" class="form-control" name="preguntas[0][enunciado]" required>

                <label>Respuestas:</label>
                <input type="text" class="form-control" name="preguntas[0][respuestas][]" required>
                <input type="text" class="form-control" name="preguntas[0][respuestas][]" required>

                <label>Respuesta correcta:</label>
                <input type="text" class="form-control" name="preguntas[0][respuesta_correcta]" required>

                <button type="button" class="btn btn-danger remove-question">Eliminar</button>
            </div>
        </div>

        <button type="button" class="btn btn-secondary" id="add-question">Añadir pregunta</button>
        <button type="submit" class="btn btn-primary">Guardar Test</button>
    </form>
</div>

<script>
document.getElementById('add-question').addEventListener('click', function () {
    let container = document.getElementById('preguntas-container');
    let index = container.children.length;
    let html = `
        <div class="pregunta">
            <label>Enunciado de la pregunta:</label>
            <input type="text" class="form-control" name="preguntas[${index}][enunciado]" required>

            <label>Respuestas:</label>
            <input type="text" class="form-control" name="preguntas[${index}][respuestas][]" required>
            <input type="text" class="form-control" name="preguntas[${index}][respuestas][]" required>

            <label>Respuesta correcta:</label>
            <input type="text" class="form-control" name="preguntas[${index}][respuesta_correcta]" required>

            <button type="button" class="btn btn-danger remove-question">Eliminar</button>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', html);
});

document.addEventListener('click', function (e) {
    if (e.target.classList.contains('remove-question')) {
        e.target.parentElement.remove();
    }
});
</script>
@endsection
<div class="container">
    <h2>Editar Test: {{ $tarea->titulo }}</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('tarea.test.update', $tarea->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="titulo" class="form-label">Título de la tarea</label>
            <input type="text" class="form-control" name="titulo" value="{{ old('titulo', $tarea->titulo) }}" required>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" name="descripcion" required>{{ old('descripcion', $tarea->descripcion) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="curso_id" class="form-label">Selecciona el curso</label>
            <select class="form-control" name="curso_id" required>
                @foreach(Auth::user()->cursos_profesor as $curso)
                    <option value="{{ $curso->id }}" {{ $curso->id == $tarea->curso_id ? 'selected' : '' }}>
                        {{ $curso->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <h4>Preguntas</h4>
        <div id="preguntas-container">
            @foreach($tarea->preguntas as $index => $pregunta)
                <div class="pregunta">
                    <label>Enunciado de la pregunta:</label>
                    <input type="text" class="form-control" name="preguntas[{{ $index }}][id]" value="{{ $pregunta->id }}" hidden>
                    <input type="text" class="form-control" name="preguntas[{{ $index }}][enunciado]" value="{{ old('preguntas.' . $index . '.enunciado', $pregunta->enunciado) }}" required>

                    <label>Respuestas:</label>
                    <div class="respuestas-container">
                        @foreach($pregunta->opciones_respuestas as $i => $opcion)
                            <div class="respuesta">
                                <input type="text" class="form-control" name="preguntas[{{ $index }}][opciones_respuestas][{{ $i }}][respuesta]" value="{{ old('preguntas.' . $index . '.opciones_respuestas.' . $i . '.respuesta', $opcion->respuesta) }}" required>
                                <input type="radio" name="preguntas[{{ $index }}][respuesta_correcta]" value="{{ $i }}" {{ old('preguntas.' . $index . '.respuesta_correcta', $pregunta->opciones_respuestas->where('es_correcta', true)->first()->id ?? '') == $opcion->id ? 'checked' : '' }}> Correcta
                            </div>
                        @endforeach
                    </div>

                    <button type="button" class="btn btn-danger remove-question">Eliminar pregunta</button>
                </div>
            @endforeach
        </div>

        <button type="button" class="btn btn-secondary" id="add-question">Añadir pregunta</button>
        <button type="submit" class="btn btn-primary">Guardar Test</button>
    </form>
</div>

<script>
   let preguntaIndex = @json($tarea->preguntas->count());


document.getElementById('add-question').addEventListener('click', function() {
    let container = document.getElementById('preguntas-container');
    
    let html = `
        <div class="pregunta">
            <label>Enunciado de la pregunta:</label>
            <input type="text" class="form-control" name="preguntas[${preguntaIndex}][enunciado]" required>

            <label>Respuestas:</label>
            <div class="respuestas-container">
                ${[0, 1, 2, 3].map(i => `
                    <div class="respuesta">
                        <input type="text" class="form-control" name="preguntas[${preguntaIndex}][opciones_respuestas][${i}][respuesta]" required>
                        <input type="radio" name="preguntas[${preguntaIndex}][respuesta_correcta]" value="${i}" required> Correcta
                    </div>
                `).join('')}
            </div>

            <button type="button" class="btn btn-danger remove-question">Eliminar pregunta</button>
        </div>
    `;
    
    container.insertAdjacentHTML('beforeend', html);
    preguntaIndex++; // Incrementar el índice para la próxima pregunta
});

document.addEventListener('click', function(e) {
    if (e.target.classList.contains('remove-question')) {
        e.target.closest('.pregunta').remove();
    }
});

</script>

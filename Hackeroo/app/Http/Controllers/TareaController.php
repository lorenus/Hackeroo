<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Tarea;
use App\Models\Curso;
use App\Models\Pregunta;
use App\Models\OpcionesRespuesta;
use App\Models\RecursoMultimedia;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class TareaController extends Controller
{
    // Mostrar formulario para crear una tarea
    public function crear($curso_id)
    {
        return view('tareas.crear', compact('curso_id'));
    }


    // Guardar una nueva tarea
    public function guardar(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'curso_id' => 'required|exists:cursos,id',
            'tipo' => 'required|in:test,archivo,link',
            'numero_preguntas' => 'nullable|integer|min:1',
            'archivo' => 'nullable|file|mimes:pdf,doc,docx,jpg,png,php,txt,html,js,css|max:2048', // Validación para archivos
            'url' => 'nullable|url', // Validación para URLs (solo si tipo es 'link')
        ]);
    
        // Si la tarea es de tipo 'test', guardar los datos en la sesión
        if ($request->tipo === 'test') {
            Session::put('test_data', [
                'titulo' => $request->titulo,
                'descripcion' => $request->descripcion,
                'curso_id' => $request->curso_id,
                'profesor_dni' => Auth::user()->DNI,
                'numero_preguntas' => $request->numero_preguntas ?? 5,
            ]);
        
            // Redirigir a la vista para configurar el test (solo con curso_id)
            return redirect()->route('tarea.test.create', ['curso_id' => $request->curso_id]);
        }
    
        // Crear la tarea para tipos 'archivo' o 'link'
        $tarea = Tarea::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'tipo' => $request->tipo,
            'curso_id' => $request->curso_id,
            'profesor_dni' => Auth::user()->DNI,
        ]);
    
        // Si la tarea es de tipo 'archivo' o 'link', creamos el recurso multimedia
        if ($request->tipo === 'archivo' || $request->tipo === 'link') {
            $url = null;
    
            if ($request->tipo === 'archivo') {
                $nombreArchivo = $request->file('archivo')->getClientOriginalName();
                $url = $request->file('archivo')->storeAs('archivos', $nombreArchivo, 'public');
            } elseif ($request->tipo === 'link') {
                $url = $request->url;
            }
    
            RecursoMultimedia::create([
                'tarea_id' => $tarea->id,
                'tipo' => $request->tipo,
                'url' => $url,
            ]);
        }
    
        // Redirigir al curso con mensaje de éxito
        return redirect()->route('cursos.show', ['id' => $request->curso_id])
            ->with('success', ucfirst($request->tipo) . ' creado correctamente');
    }


    // Crear test - Vista para configurar el test
    public function crearTest($curso_id)
    {
        // Obtener los datos del test desde la sesión
        $testData = Session::get('test_data');
    
        // Si no hay datos en la sesión, redirigir con un mensaje de error
        if (!$testData) {
            return redirect()->route('cursos.show', ['id' => $curso_id])
                ->with('error', 'No se encontraron datos para configurar el test.');
        }
    
        // Obtener el número de preguntas de los datos almacenados
        $numero_preguntas = $testData['numero_preguntas'] ?? 5;
    
        return view('tareas.configurar-test', compact('curso_id', 'numero_preguntas'));
    }
    public function guardarTest(Request $request, $curso_id)
    {
        // Validar los datos del test
        $request->validate([
            'preguntas' => 'required|array',
            'preguntas.*.enunciado' => 'required|string',
            'preguntas.*.opciones' => 'required|array|min:2',
            'preguntas.*.respuesta_correcta' => 'required|string',
        ]);
    
        // Obtener los datos del test desde la sesión
        $testData = Session::get('test_data');
    
        // Si no hay datos en la sesión, redirigir con un mensaje de error
        if (!$testData) {
            return redirect()->route('cursos.show', ['id' => $curso_id])
                ->with('error', 'No se encontraron datos para guardar el test.');
        }
    
        // Crear la tarea
        $tarea = Tarea::create([
            'titulo' => $testData['titulo'],
            'descripcion' => $testData['descripcion'],
            'tipo' => 'test',
            'curso_id' => $testData['curso_id'],
            'profesor_dni' => $testData['profesor_dni'],
        ]);
    
        // Guardar las preguntas y respuestas
        foreach ($request->preguntas as $preguntaData) {
            $pregunta = Pregunta::create([
                'tarea_id' => $tarea->id,
                'enunciado' => $preguntaData['enunciado'],
                'tipo' => 'test',
            ]);
    
            foreach ($preguntaData['opciones'] as $j => $opcionData) {
                OpcionesRespuesta::create([
                    'pregunta_id' => $pregunta->id,
                    'respuesta' => $opcionData['respuesta'],
                    'es_correcta' => ($j == $preguntaData['respuesta_correcta']),
                ]);
            }
        }
    
        // Limpiar los datos del test de la sesión
        Session::forget('test_data');
    
        // Redirigir con mensaje de éxito
        return redirect()->route('cursos.show', ['id' => $curso_id])
            ->with('success', 'Test creado correctamente');
    }
    public function eliminar($curso_id, $tarea_id)
    {
        // Buscar la tarea
        $tarea = Tarea::where('id', $tarea_id)->where('curso_id', $curso_id)->firstOrFail();
    
        // Verificar si la tarea tiene un recurso multimedia asociado
        $recurso = RecursoMultimedia::where('tarea_id', $tarea->id)->first();
    
        if ($recurso && $recurso->tipo === 'archivo') {
            // Eliminar el archivo del sistema de archivos
            if (Storage::disk('public')->exists($recurso->url)) {
                Storage::disk('public')->delete($recurso->url);
            }
    
            // Eliminar el recurso multimedia de la base de datos
            $recurso->delete();
        }
    
        // Eliminar la tarea
        $tarea->delete();
    
        // Redirigir con mensaje de éxito
        return redirect()->route('cursos.show', ['id' => $curso_id])->with('success', 'Tarea eliminada correctamente');
    }
    public function mostrarTareas($curso_id)
    {
        $curso = Curso::with('tareas')->findOrFail($curso_id);


        return view('cursos.tareas', compact('curso'));
    }
    public function verTarea($curso_id, $tarea_id)
    {
        $tarea = Tarea::with('preguntas.opciones_respuestas')->findOrFail($tarea_id);

        switch ($tarea->tipo) {
            case 'test':
                return view('tareas.ver', compact('tarea', 'curso_id')); // Vista para ver el test
            case 'archivo':
                $recurso = RecursoMultimedia::where('tarea_id', $tarea->id)->first();
                return view('tareas.ver-archivo', compact('tarea', 'curso_id', 'recurso')); // Vista para ver archivos
            case 'link':
                $recurso = RecursoMultimedia::where('tarea_id', $tarea->id)->first();
                return redirect()->away($recurso->url); // Redirección externa para links
            default:
                return redirect()->route('cursos.show', $curso_id)->with('error', 'Tipo de tarea desconocido');
        }
    }
    public function enviarRespuestas(Request $request, $curso_id, $tarea_id)
    {
        // Obtener la tarea y el curso
        $curso = Curso::findOrFail($curso_id);
        $tarea = Tarea::findOrFail($tarea_id);


        // Inicializar un array para almacenar los resultados
        $resultados = [];


        // Evaluar cada pregunta
        foreach ($tarea->preguntas as $pregunta) {
            // Verificar si se ha enviado una respuesta para esta pregunta
            $respuesta_usuario = $request->input('pregunta.' . $pregunta->id);


            // Si el usuario ha respondido
            if ($respuesta_usuario) {
                // Obtener la opción seleccionada por el alumno
                $opcion = $pregunta->opciones_respuestas()->find($respuesta_usuario);


                // Verificar si la opción seleccionada es correcta
                // Aquí comparamos con el campo `es_correcta`
                $resultados[] = [
                    'pregunta' => $pregunta->enunciado,
                    'respuesta_usuario' => $opcion->respuesta,
                    'respuesta_correcta' => $opcion->es_correcta ? 'Correcta' : 'Incorrecta',  // Verificamos si es correcta
                    'acertada' => $opcion->es_correcta // Aquí verificamos si la respuesta es correcta
                ];
            }
        }


        // Calcular el puntaje (puedes hacerlo si quieres mostrar el puntaje total)
        $aciertos = count(array_filter($resultados, fn($resultado) => $resultado['acertada']));
        $total = count($tarea->preguntas);


        // Pasar los resultados a la vista para mostrar al usuario
        return view('tareas.resultado', compact('resultados', 'aciertos', 'total', 'curso', 'tarea'));
    }
}

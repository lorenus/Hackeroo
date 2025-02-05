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
            'numero_preguntas' => 'nullable|integer|min:1'
        ]);

        // Crear la tarea
        $tarea = Tarea::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'tipo' => $request->tipo,
            'curso_id' => $request->curso_id,
            'profesor_dni' => Auth::user()->DNI,
        ]);

        // Si la tarea es de tipo 'test', redirigimos a la vista para configurar el test
        if ($request->tipo === 'test') {
            Session::put('numero_preguntas', $request->numero_preguntas ?? 5); // Si no se pasa, se asigna 5
            return redirect()->route('tarea.test.create', ['curso_id' => $request->curso_id]);
        }

        // Si la tarea es de tipo 'archivo' o 'link', creamos el recurso multimedia en la misma vista
        if ($request->tipo === 'archivo' || $request->tipo === 'link') {
            $recurso = RecursoMultimedia::create([
                'tarea_id' => $tarea->id,
                'tipo' => $request->tipo,
                'url' => $request->url ?? $request->file('archivo')->store('archivos', 'public'), // 'url' si es link, 'archivo' si es archivo
            ]);

            return redirect()->route('cursos.show', ['id' => $request->curso_id])->with('success', ucfirst($request->tipo) . ' creado correctamente');
        }
    }

    // Crear test - Vista para configurar el test
    public function crearTest($curso_id)
    {
        $tarea = Tarea::where('curso_id', $curso_id)->firstOrFail();

        // Obtener el número de preguntas de la sesión
        $numero_preguntas = Session::get('numero_preguntas', 5); // Valor predeterminado si no existe

        return view('tareas.configurar-test', compact('tarea', 'curso_id', 'numero_preguntas'));
    }
    public function guardarTest(Request $request, $curso_id)
    {
        $tarea = Tarea::where('curso_id', $curso_id)->firstOrFail();
    
        $request->validate([
            'preguntas' => 'required|array',
            'preguntas.*.enunciado' => 'required|string',
            'preguntas.*.opciones' => 'required|array|min:2',
            'preguntas.*.respuesta_correcta' => 'required|string',
        ]);
    
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
                    'es_correcta' => ($j == $preguntaData['respuesta_correcta']), // Comparar con la respuesta correcta
                ]);
            }
        }
    
        return redirect()->route('cursos.show', ['id' => $curso_id])->with('success', 'Test creado correctamente');
    }
    public function eliminar($curso_id, $tarea_id)
    {
        $tarea = Tarea::where('id', $tarea_id)->where('curso_id', $curso_id)->firstOrFail();
        $tarea->delete();

        return redirect()->route('cursos.show', ['id' => $curso_id])->with('success', 'Tarea eliminada correctamente');
    }
    public function show($curso_id, $tarea_id)
    {
        $curso = Curso::findOrFail($curso_id);
        $tarea = Tarea::with('preguntas.opciones_respuestas')->findOrFail($tarea_id);


        return view('tareas.show', compact('curso', 'tarea'));
    }
    public function responder(Request $request, $curso_id, $tarea_id)
    {
        $validated = $request->validate([
            'respuesta' => 'required|array', // Asegura que se envíe al menos una respuesta
            'respuesta.*' => 'required|exists:opciones_respuestas,id',
        ]);

        $tarea = Tarea::with('preguntas.opciones_respuestas')->findOrFail($tarea_id);
        $respuestas_usuario = $request->input('respuesta'); // Respuestas enviadas por el usuario

        $resultados = []; // Guarda el resultado de cada pregunta
        $aciertos = 0;
        $errores = 0;

        foreach ($tarea->preguntas as $pregunta) {
            if (isset($respuestas_usuario[$pregunta->id])) {
                $opcion_seleccionada_id = $respuestas_usuario[$pregunta->id];
                $opcion_seleccionada = OpcionesRespuesta::find($opcion_seleccionada_id);
                $correcta = $pregunta->opciones_respuestas->where('es_correcta', true)->first();

                $correcto = $opcion_seleccionada && $opcion_seleccionada->es_correcta;
                $correcto ? $aciertos++ : $errores++;

                $resultados[] = [
                    'pregunta' => $pregunta->enunciado,
                    'respuesta_usuario' => $opcion_seleccionada->respuesta ?? 'No respondida',
                    'correcta' => $correcta->respuesta ?? 'No definida',
                    'es_correcta' => $correcto
                ];
            }
        }

        // Guardar resultados en sesión
        session([
            'resultados' => $resultados,
            'aciertos' => $aciertos,
            'errores' => $errores
        ]);

        return redirect()->route('tarea.resultados', ['curso_id' => $curso_id, 'tarea_id' => $tarea_id]);
    }

    public function mostrarResultados($curso_id, $tarea_id)
{
    $curso = Curso::findOrFail($curso_id);
    $tarea = Tarea::findOrFail($tarea_id);
    $resultados = session('resultados', []);
    $aciertos = session('aciertos', 0);
    $errores = session('errores', 0);

    return view('tareas.resultados', compact('curso', 'tarea', 'resultados', 'aciertos', 'errores'));
}

}

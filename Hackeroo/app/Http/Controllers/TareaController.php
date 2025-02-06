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
use Illuminate\Support\Facades\DB;


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
    public function mostrarTareas($curso_id)
    {
        $curso = Curso::with('tareas')->findOrFail($curso_id);

        return view('cursos.tareas', compact('curso'));
    }
    public function verTarea($curso_id, $tarea_id)
    {
        $tarea = Tarea::findOrFail($tarea_id);

        switch ($tarea->tipo) {
            case 'test':
                return view('tareas.ver', compact('tarea', 'curso_id'));
            case 'archivo':
                $recurso = RecursoMultimedia::where('tarea_id', $tarea->id)->first();
                return view('tareas.ver-archivo', compact('tarea', 'curso_id', 'recurso'));
            case 'link':
                $recurso = RecursoMultimedia::where('tarea_id', $tarea->id)->first();
                return redirect()->away($recurso->url);
            default:
                return redirect()->route('cursos.show', $curso_id)->with('error', 'Tipo de tarea desconocido');
        }
    }

    public function enviarRespuestas(Request $request, $curso_id, $tarea_id)
    {
        // Obtener la tarea y el curso
        $curso = Curso::findOrFail($curso_id);
        $tarea = Tarea::with('preguntas.opciones_respuestas')->findOrFail($tarea_id);
        $usuario = Auth::user(); // Obtener el usuario autenticado

        // Inicializar un array para almacenar los resultados
        $resultados = [];

        foreach ($tarea->preguntas as $pregunta) {
            // Verificar si el usuario ha respondido esta pregunta
            $respuesta_usuario = $request->input('pregunta.' . $pregunta->id);

            if ($respuesta_usuario) {
                // Obtener la opción seleccionada
                $opcion = $pregunta->opciones_respuestas()->find($respuesta_usuario);

                // Guardar la respuesta en la base de datos
                DB::table('respuestas_alumnos')->insert([
                    'pregunta_id' => $pregunta->id,
                    'usuario_dni' => $usuario->DNI,
                    'opcion_respuesta_id' => $opcion->id,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);

                // Evaluar si la respuesta es correcta
                $resultados[] = [
                    'pregunta' => $pregunta->enunciado,
                    'respuesta_usuario' => $opcion->respuesta,
                    'respuesta_correcta' => $opcion->es_correcta ? 'Correcta' : 'Incorrecta',
                    'acertada' => $opcion->es_correcta
                ];
            }
        }

        // Calcular el puntaje
        $aciertos = count(array_filter($resultados, fn($resultado) => $resultado['acertada']));
        $total = count($tarea->preguntas);

        return view('tareas.resultado', compact('resultados', 'aciertos', 'total', 'curso', 'tarea'));
    }
}

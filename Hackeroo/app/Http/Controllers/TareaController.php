<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarea;
use App\Models\Pregunta;
use App\Models\OpcionesRespuesta;
use Illuminate\Support\Facades\Auth;

class TareaController extends Controller
{
    public function index()
    {
        // Obtener las tareas de los cursos que el profesor imparte
        $tareas = Tarea::whereHas('curso', function ($query) {
            $query->where('profesor_dni', Auth::user()->DNI);
        })->get();

        return view('tareas.index', compact('tareas'));
    }

    public function crearTest()
    {
        return view('tareas.configurar-test');
    }

    public function guardarTest(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'curso_id' => 'required|exists:cursos,id',
            'preguntas' => 'required|array',
            'preguntas.*.enunciado' => 'required|string',
            'preguntas.*.opcionesespuestas' => 'required|array|min:2', // Al menos 2 respuestas
            'preguntas.*.respuesta_correcta' => 'required|string',
        ]);

        $tarea = Tarea::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'tipo' => 'test',
            'curso_id' => $request->curso_id,
            'profesor_dni' => Auth::user()->DNI,
        ]);

        foreach ($request->preguntas as $preguntaData) {
            $pregunta = Pregunta::create([
                'tarea_id' => $tarea->id,
                'enunciado' => $preguntaData['enunciado'],
                'tipo' => 'test',
            ]);

            foreach ($preguntaData['opcionesespuestas'] as $opcionData) {
                OpcionesRespuesta::create([
                    'pregunta_id' => $pregunta->id,
                    'respuesta' => $opcionData['respuesta'],
                    'es_correcta' => $opcionData['es_correcta'] == '1',
                ]);
            }
        }

        return redirect()->route('tarea.test.create')->with('success', 'Test creado correctamente');
    }



    // Mostrar el formulario para editar un test
    public function editarTest($id)
    {
        $tarea = Tarea::with('preguntas.opciones_respuestas')->findOrFail($id);

        return view('tareas.editar-test', compact('tarea'));
    }

    // Actualizar un test existente
    public function actualizarTest(Request $request, $id)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'curso_id' => 'required|exists:cursos,id',
            'preguntas' => 'required|array',
            'preguntas.*.enunciado' => 'required|string',
            'preguntas.*.opciones_respuestas' => 'required|array|min:2',
            'preguntas.*.respuesta_correcta' => 'required|integer',
        ]);

        // Actualizar la tarea
        $tarea = Tarea::findOrFail($id);
        $tarea->update([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'curso_id' => $request->curso_id,
        ]);

        // Actualizar las preguntas y sus opciones
        foreach ($request->preguntas as $preguntaData) {
            $pregunta = Pregunta::create([
                'tarea_id' => $tarea->id,
                'enunciado' => $preguntaData['enunciado'],
                'tipo' => 'test',
            ]);
        
            foreach ($preguntaData['opciones_respuestas'] as $opcionData) {
                OpcionesRespuesta::create([
                    'pregunta_id' => $pregunta->id,
                    'respuesta' => $opcionData['respuesta'],
                    'es_correcta' => isset($opcionData['es_correcta']) && $opcionData['es_correcta'] == '1',
                ]);
            }
            
        }
        

        return redirect()->route('tarea.test.index')->with('success', 'Test actualizado correctamente');
    }

    // Eliminar un test
    public function eliminarTest($id)
    {
        $tarea = Tarea::findOrFail($id);
        $tarea->delete();

        return redirect()->route('tarea.test.index')->with('success', 'Test eliminado correctamente');
    }
}

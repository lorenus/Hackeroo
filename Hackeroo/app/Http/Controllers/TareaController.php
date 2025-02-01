<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarea;
use App\Models\Pregunta;
use App\Models\Respuesta;
use Illuminate\Support\Facades\Auth;

class TareaController extends Controller
{
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
            'preguntas.*.respuestas' => 'required|array|min:2', // Al menos 2 respuestas
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

            foreach ($preguntaData['respuestas'] as $respuestaTexto) {
                Respuesta::create([
                    'pregunta_id' => $pregunta->id,
                    'texto' => $respuestaTexto,
                    'es_correcta' => $respuestaTexto === $preguntaData['respuesta_correcta'],
                ]);
            }
        }

        return redirect()->route('tarea.test.create')->with('success', 'Test creado correctamente');
    }
}

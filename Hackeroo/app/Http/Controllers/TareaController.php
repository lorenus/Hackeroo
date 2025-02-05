<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarea;
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

        $tarea = Tarea::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'tipo' => $request->tipo,
            'curso_id' => $request->curso_id,
            'profesor_dni' => Auth::user()->DNI,
        ]);
      

        if ($request->tipo === 'test') {
            Session::put('numero_preguntas', $request->numero_preguntas);
            return redirect()->route('tarea.test.create', ['curso_id' => $request->curso_id]);
        } elseif ($request->tipo === 'archivo') {
            return redirect()->route('tarea.archivo.create', ['curso_id' => $request->curso_id]);
        } else {
            return redirect()->route('tarea.link.create', ['curso_id' => $request->curso_id]);
        }
    }

    public function crearTest($curso_id)
    {
        $tarea = Tarea::where('curso_id', $curso_id)->firstOrFail();
       
        // Obtener el número de preguntas de la sesión
        $numero_preguntas = Session::get('numero_preguntas', 5); // Valor predeterminado si no existe
    
        return view('tareas.configurar-test', compact('tarea', 'curso_id', 'numero_preguntas'));
    }

    // Guardar un test
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

            foreach ($preguntaData['opciones'] as $opcionData) {
                OpcionesRespuesta::create([
                    'pregunta_id' => $pregunta->id,
                    'respuesta' => $opcionData['respuesta'],
                    'es_correcta' => $opcionData['es_correcta'] == '1',
                ]);
            }
        }

        return redirect()->route('cursos.show', ['id' => $curso_id])->with('success', 'Test creado correctamente');
    }

    // Mostrar formulario para subir un archivo
    public function crearArchivo($curso_id)
    {
        $tarea = Tarea::where('curso_id', $curso_id)->firstOrFail();
        return view('tareas.subir-archivo', compact('tarea', 'curso_id'));
    }

    // Guardar un archivo
    public function guardarArchivo(Request $request, $curso_id)
    {
        $tarea = Tarea::where('curso_id', $curso_id)->firstOrFail();

        $request->validate([
            'archivo' => 'required|file|mimes:pdf,doc,docx,ppt,pptx|max:10240', // 2MB máximo
        ]);

        $ruta = $request->file('archivo')->store('archivos', 'public');
        RecursoMultimedia::create([
            'tarea_id' => $tarea->id,
            'tipo' => 'archivo',
            'url' => $ruta,
        ]);

        return redirect()->route('cursos.show', ['id' => $curso_id])->with('success', 'Archivo subido correctamente');
    }

    // Mostrar formulario para agregar un link
    public function crearLink($curso_id)
    {
        $tarea = Tarea::where('curso_id', $curso_id)->firstOrFail();
        return view('tareas.link', compact('tarea', 'curso_id'));
    }

    // Guardar un link
    public function guardarLink(Request $request, $curso_id)
    {
        $tarea = Tarea::where('curso_id', $curso_id)->firstOrFail();

        $request->validate([
            'url' => 'required|url',
        ]);

        RecursoMultimedia::create([
            'tarea_id' => $tarea->id,
            'tipo' => 'link',
            'url' => $request->url,
        ]);

        return redirect()->route('cursos.show', ['id' => $curso_id])->with('success', 'Link agregado correctamente');
    }

    // Eliminar una tarea
    public function eliminar($curso_id, $tarea_id)
    {
        $tarea = Tarea::where('id', $tarea_id)->where('curso_id', $curso_id)->firstOrFail();
        $tarea->delete();

        return redirect()->route('cursos.show', ['id' => $curso_id])->with('success', 'Tarea eliminada correctamente');
    }
}
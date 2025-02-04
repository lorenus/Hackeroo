<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarea;
use App\Models\Pregunta;
use App\Models\OpcionesRespuesta;
use App\Models\RecursoMultimedia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;


class TareaController extends Controller
{
    public function crear($curso_id)
    {
        return view('tareas.crear',compact('curso_id'));
    }

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
            return redirect()->route('tarea.test.create', ['id' => $tarea->id]);
        } elseif ($request->tipo === 'archivo') {
            return redirect()->route('tarea.archivo.create', ['id' => $tarea->id]);
        } else {
            return redirect()->route('tarea.link.create', ['id' => $tarea->id]);
        }
    }

    public function crearTest($id)
    {
        $tarea = Tarea::findOrFail($id);
        return view('tareas.configurar-test', compact('tarea'));
    }

    public function guardarTest(Request $request, $id)
    {
        $request->validate([
            'preguntas' => 'required|array',
            'preguntas.*.enunciado' => 'required|string',
            'preguntas.*.opciones' => 'required|array|min:2',
            'preguntas.*.respuesta_correcta' => 'required|string',
        ]);

        foreach ($request->preguntas as $preguntaData) {
            $pregunta = Pregunta::create([
                'tarea_id' => $id,
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

        return redirect()->route('tarea.index')->with('success', 'Test creado correctamente');
    }

    public function crearArchivo($id)
    {
        $tarea = Tarea::findOrFail($id);
        return view('tareas.subir-archivo', compact('tarea'));
    }

    public function guardarArchivo(Request $request, $id)
    {
        $request->validate([
            'archivo' => 'required|file|mimes:pdf,doc,docx,ppt,pptx',
        ]);

        $ruta = $request->file('archivo')->store('archivos', 'public');
        RecursoMultimedia::create([
            'tarea_id' => $id,
            'tipo' => 'archivo',
            'url' => $ruta,
        ]);

        return redirect()->route('tarea.index')->with('success', 'Archivo subido correctamente');
    }

    public function crearLink($id)
    {
        $tarea = Tarea::findOrFail($id);
        return view('tareas.agregar-link', compact('tarea'));
    }

    public function guardarLink(Request $request, $id)
    {
        $request->validate([
            'url' => 'required|url',
        ]);

        RecursoMultimedia::create([
            'tarea_id' => $id,
            'tipo' => 'link',
            'url' => $request->url,
        ]);

        return redirect()->route('tarea.index')->with('success', 'Link agregado correctamente');
    }
    public function eliminar($id)
    {
        $tarea = Tarea::findOrFail($id);
        $tarea->delete();
        return redirect()->route('tarea.index')->with('success', 'Tarea eliminada correctamente');
    }
}
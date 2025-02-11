<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Tarea;
use App\Models\Curso;
use App\Models\Pregunta;
use App\Models\OpcionesRespuesta;
use App\Models\RespuestasAlumno;
use App\Models\RecursoMultimedia;
use App\Models\Usuario;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class TareaController extends Controller
{
    public function crear($curso_id)
    {
        return view('tareas.crear', compact('curso_id'));
    }

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
    
        if ($request->tipo === 'test') {
            Session::put('test_data', [
                'titulo' => $request->titulo,
                'descripcion' => $request->descripcion,
                'curso_id' => $request->curso_id,
                'profesor_dni' => Auth::user()->DNI,
                'numero_preguntas' => $request->numero_preguntas ?? 5,
            ]);
        
            return redirect()->route('tarea.test.create', ['curso_id' => $request->curso_id]);
        }
    
        $tarea = Tarea::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'tipo' => $request->tipo,
            'curso_id' => $request->curso_id,
            'profesor_dni' => Auth::user()->DNI,
        ]);
    
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
    
        return redirect()->route('cursos.show', ['id' => $request->curso_id])
            ->with('success', ucfirst($request->tipo) . ' creado correctamente');
    }


    public function crearTest($curso_id)
    {
        $testData = Session::get('test_data');
    
        if (!$testData) {
            return redirect()->route('cursos.show', ['id' => $curso_id])
                ->with('error', 'No se encontraron datos para configurar el test.');
        }
    
        $numero_preguntas = $testData['numero_preguntas'] ?? 5;
    
        return view('tareas.configurar-test', compact('curso_id', 'numero_preguntas'));
    }
    public function guardarTest(Request $request, $curso_id)
    {
        $request->validate([
            'preguntas' => 'required|array',
            'preguntas.*.enunciado' => 'required|string',
            'preguntas.*.opciones' => 'required|array|min:2',
            'preguntas.*.respuesta_correcta' => 'required|string',
        ]);
    
        $testData = Session::get('test_data');
    
        if (!$testData) {
            return redirect()->route('cursos.show', ['id' => $curso_id])
                ->with('error', 'No se encontraron datos para guardar el test.');
        }
    
        $tarea = Tarea::create([
            'titulo' => $testData['titulo'],
            'descripcion' => $testData['descripcion'],
            'tipo' => 'test',
            'curso_id' => $testData['curso_id'],
            'profesor_dni' => $testData['profesor_dni'],
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
                    'es_correcta' => ($j == $preguntaData['respuesta_correcta']),
                ]);
            }
        }
    
        Session::forget('test_data');
    
        return redirect()->route('cursos.show', ['id' => $curso_id])
            ->with('success', 'Test creado correctamente');
    }
    public function eliminar($curso_id, $tarea_id)
    {
        $tarea = Tarea::where('id', $tarea_id)->where('curso_id', $curso_id)->firstOrFail();
    
        $recurso = RecursoMultimedia::where('tarea_id', $tarea->id)->first();
    
        if ($recurso && $recurso->tipo === 'archivo') {
            if (Storage::disk('public')->exists($recurso->url)) {
                Storage::disk('public')->delete($recurso->url);
            }
    
            $recurso->delete();
        }
    
        $tarea->delete();
    
        return redirect()->route('cursos.show', ['id' => $curso_id])->with('success', 'Tarea eliminada correctamente');
    }
    public function editRecurso($id)
{
    $tarea = Tarea::with('recursoMultimedia')->findOrFail($id);

    if (Auth::user()->rol !== 'profesor') {
        abort(403, 'No tienes permiso para realizar esta acción.');
    }

    if (!$tarea->recursoMultimedia) {
        return redirect()->route('cursos.show', $tarea->curso_id)->with('error', 'No se encontró ningún recurso asociado a esta tarea.');
    }

    return view('tareas.edit-recurso', compact('tarea'));
}
public function updateRecurso(Request $request, $id)
{
    $request->validate([
        'tipo' => 'required|in:archivo,link',
        'archivo' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:2048', 
        'url' => 'nullable|url', 
    ]);

    $tarea = Tarea::findOrFail($id);

    if (Auth::user()->rol !== 'profesor') {
        abort(403, 'No tienes permiso para realizar esta acción.');
    }

    $recurso = $tarea->recursoMultimedia;

    if (!$recurso) {
        return redirect()->route('cursos.show', $tarea->curso_id)->with('error', 'No se encontró ningún recurso asociado a esta tarea.');
    }

    if ($request->tipo === 'archivo') {
        if (!$request->hasFile('archivo')) {
            return redirect()->back()->with('error', 'Debes subir un archivo.');
        }

        if ($recurso->tipo === 'archivo' && Storage::disk('public')->exists($recurso->url)) {
            Storage::disk('public')->delete($recurso->url);
        }

        $nombreArchivo = $request->file('archivo')->getClientOriginalName();
        $url = $request->file('archivo')->storeAs('archivos', $nombreArchivo, 'public');
    } elseif ($request->tipo === 'link') {
        $url = $request->url;
    }

    $recurso->update([
        'tipo' => $request->tipo,
        'url' => $url,
    ]);

    return redirect()->route('cursos.show', ['id' => $tarea->curso_id])
        ->with('success', 'Recurso actualizado correctamente.');
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
                $respuestasUsuario = RespuestasAlumno::where('usuario_dni', Auth::user()->DNI)
                    ->whereIn('pregunta_id', $tarea->preguntas->pluck('id'))
                    ->get();
    
                $totalPreguntas = $tarea->preguntas->count();
                $preguntasRespondidas = $respuestasUsuario->count();
    
                if ($preguntasRespondidas === $totalPreguntas) {
                    return redirect()->route('tarea.resultados', ['curso_id' => $curso_id, 'tarea_id' => $tarea_id]);
                }
    
                return view('tareas.ver', compact('tarea', 'curso_id'));
    
            case 'archivo':
                $recurso = RecursoMultimedia::where('tarea_id', $tarea->id)->first();
    
                if (!$recurso) {
                    return redirect()->route('cursos.show', $curso_id)->with('error', 'No se encontró el archivo asociado a esta tarea.');
                }
    
                return view('tareas.ver-archivo', compact('tarea', 'curso_id', 'recurso'));
    
            case 'link':
                $recurso = RecursoMultimedia::where('tarea_id', $tarea->id)->first();
    
                if (!$recurso) {
                    return redirect()->route('cursos.show', $curso_id)->with('error', 'No se encontró el enlace asociado a esta tarea.');
                }
    
                return redirect()->away($recurso->url);
    
            default:
                return redirect()->route('cursos.show', $curso_id)->with('error', 'Tipo de tarea desconocido');
        }
    }
    public function enviarRespuestas(Request $request, $curso_id, $tarea_id)
    {
       
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para enviar respuestas.');
        }
    
        $curso = Curso::findOrFail($curso_id);
        $tarea = Tarea::findOrFail($tarea_id);
    
       
        $resultados = [];
        $puntuacion = 0;
        $aciertos = 0; 
        $total_preguntas = $tarea->preguntas->count();
        $valor_pregunta = 10 / $total_preguntas;
        $penalizacion = $valor_pregunta / 3; 
    
      
        foreach ($tarea->preguntas as $pregunta) {
        
            $respuesta_previa = RespuestasAlumno::where('pregunta_id', $pregunta->id)
                ->where('usuario_dni', Auth::user()->DNI)
                ->first();
    
            if ($respuesta_previa) {
             
                continue;
            }
    
 
            $respuesta_usuario = $request->input('pregunta.' . $pregunta->id);
    
            if ($respuesta_usuario) {
          
                $opcion = $pregunta->opciones_respuestas()->find($respuesta_usuario);
    
               
                RespuestasAlumno::create([
                    'pregunta_id' => $pregunta->id,
                    'usuario_dni' => Auth::user()->DNI, 
                    'opcion_respuesta_id' => $opcion->id,
                ]);
    
                if ($opcion->es_correcta) {
                    $puntuacion += $valor_pregunta; 
                    $aciertos++; 
                    $resultado = 'Correcta';
                } else {
                    $puntuacion -= $penalizacion; 
                    $resultado = 'Incorrecta';
                }
            } else {
              
                RespuestasAlumno::create([
                    'pregunta_id' => $pregunta->id,
                    'usuario_dni' => Auth::user()->DNI,
                    'opcion_respuesta_id' => null, 
                ]);
                $resultado = 'Sin responder';
            }
    
    
            $resultados[] = [
                'pregunta' => $pregunta->enunciado,
                'respuesta_usuario' => $respuesta_usuario ? $opcion->respuesta : 'Sin responder',
                'resultado' => $resultado,
            ];
        }
    
   
        $puntuacion = max(0, $puntuacion);
    
        
        $usuario = Auth::user(); 
    
        if ($usuario instanceof Usuario) { 
            $usuario->puntos += $puntuacion; 
            $usuario->save(); 
        } else {
            return redirect()->back()->with('error', 'No se pudo actualizar la puntuación del usuario.');
        }
    

        return view('tareas.resultado', compact('resultados', 'puntuacion', 'aciertos', 'total_preguntas', 'curso', 'tarea'));
    }
    public function mostrarResultados($curso_id, $tarea_id)
    {
      
        $curso = Curso::findOrFail($curso_id);
        $tarea = Tarea::findOrFail($tarea_id);
    
    
        $respuestasUsuario = RespuestasAlumno::where('usuario_dni', Auth::user()->DNI)
            ->whereIn('pregunta_id', $tarea->preguntas->pluck('id'))
            ->get();
    
     
        $resultados = [];
        $puntuacion = 0;
        $aciertos = 0;
        $total_preguntas = $tarea->preguntas->count();
        $valor_pregunta = 10 / $total_preguntas;
        $penalizacion = $valor_pregunta / 3;
    
  
        foreach ($tarea->preguntas as $pregunta) {
            $respuesta = $respuestasUsuario->firstWhere('pregunta_id', $pregunta->id);
    
            if ($respuesta && $respuesta->opcion_respuesta_id) {
                $opcion = $pregunta->opciones_respuestas()->find($respuesta->opcion_respuesta_id);
    
                if ($opcion->es_correcta) {
                    $puntuacion += $valor_pregunta;
                    $aciertos++;
                    $resultado = 'Correcta';
                } else {
                    $puntuacion -= $penalizacion;
                    $resultado = 'Incorrecta';
                }
            } else {
                $resultado = 'Sin responder';
            }
    
            $resultados[] = [
                'pregunta' => $pregunta->enunciado,
                'respuesta_usuario' => $respuesta && $respuesta->opcion_respuesta_id ? $opcion->respuesta : 'Sin responder',
                'resultado' => $resultado,
            ];
        }
    

        $puntuacion = max(0, $puntuacion);
    

        return view('tareas.resultado', compact('resultados', 'puntuacion', 'aciertos', 'total_preguntas', 'curso', 'tarea'));
    }
    

}
   
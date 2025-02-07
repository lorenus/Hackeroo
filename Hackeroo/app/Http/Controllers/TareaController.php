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
        // Obtener la tarea con sus preguntas y opciones de respuesta (si es un test)
        $tarea = Tarea::with('preguntas.opciones_respuestas')->findOrFail($tarea_id);
    
        // Manejar cada tipo de tarea según su tipo
        switch ($tarea->tipo) {
            case 'test':
                // Verificar si el usuario ya ha respondido todas las preguntas de este test
                $respuestasUsuario = RespuestasAlumno::where('usuario_dni', Auth::user()->DNI)
                    ->whereIn('pregunta_id', $tarea->preguntas->pluck('id'))
                    ->get();
    
                $totalPreguntas = $tarea->preguntas->count();
                $preguntasRespondidas = $respuestasUsuario->count();
    
                if ($preguntasRespondidas === $totalPreguntas) {
                    // Si ha respondido a todas las preguntas, redirigir a la vista de resultados
                    return redirect()->route('tarea.resultados', ['curso_id' => $curso_id, 'tarea_id' => $tarea_id]);
                }
    
                // Si no ha respondido a todas las preguntas, mostrar la vista para realizar el test
                return view('tareas.ver', compact('tarea', 'curso_id'));
    
            case 'archivo':
                // Obtener el recurso multimedia asociado a la tarea
                $recurso = RecursoMultimedia::where('tarea_id', $tarea->id)->first();
    
                if (!$recurso) {
                    return redirect()->route('cursos.show', $curso_id)->with('error', 'No se encontró el archivo asociado a esta tarea.');
                }
    
                // Mostrar la vista para ver archivos
                return view('tareas.ver-archivo', compact('tarea', 'curso_id', 'recurso'));
    
            case 'link':
                // Obtener el recurso multimedia asociado a la tarea
                $recurso = RecursoMultimedia::where('tarea_id', $tarea->id)->first();
    
                if (!$recurso) {
                    return redirect()->route('cursos.show', $curso_id)->with('error', 'No se encontró el enlace asociado a esta tarea.');
                }
    
                // Redirigir al enlace externo
                return redirect()->away($recurso->url);
    
            default:
                // Si el tipo de tarea no es reconocido, redirigir con un mensaje de error
                return redirect()->route('cursos.show', $curso_id)->with('error', 'Tipo de tarea desconocido');
        }
    }
    public function enviarRespuestas(Request $request, $curso_id, $tarea_id)
    {
        // Verificar si el usuario está autenticado
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para enviar respuestas.');
        }
    
        $curso = Curso::findOrFail($curso_id);
        $tarea = Tarea::findOrFail($tarea_id);
    
        // Inicializar variables
        $resultados = [];
        $puntuacion = 0;
        $aciertos = 0; // Contador de aciertos
        $total_preguntas = $tarea->preguntas->count();
        $valor_pregunta = 10 / $total_preguntas; // Valor proporcional de cada pregunta
        $penalizacion = $valor_pregunta / 3; // Penalización por pregunta incorrecta
    
        // Recorrer cada pregunta de la tarea
        foreach ($tarea->preguntas as $pregunta) {
            // Verificar si el usuario ya ha respondido esta pregunta
            $respuesta_previa = RespuestasAlumno::where('pregunta_id', $pregunta->id)
                ->where('usuario_dni', Auth::user()->DNI)
                ->first();
    
            if ($respuesta_previa) {
                // Si ya respondió, saltar esta pregunta
                continue;
            }
    
            // Verificar si se ha enviado una respuesta para esta pregunta
            $respuesta_usuario = $request->input('pregunta.' . $pregunta->id);
    
            if ($respuesta_usuario) {
                // Obtener la opción seleccionada por el alumno
                $opcion = $pregunta->opciones_respuestas()->find($respuesta_usuario);
    
                // Guardar la respuesta del alumno en la tabla respuestas_alumnos
                RespuestasAlumno::create([
                    'pregunta_id' => $pregunta->id,
                    'usuario_dni' => Auth::user()->DNI, // Suponemos que el usuario está autenticado
                    'opcion_respuesta_id' => $opcion->id,
                ]);
    
                // Evaluar si la respuesta es correcta
                if ($opcion->es_correcta) {
                    $puntuacion += $valor_pregunta; // Sumar el valor de la pregunta
                    $aciertos++; // Incrementar el contador de aciertos
                    $resultado = 'Correcta';
                } else {
                    $puntuacion -= $penalizacion; // Restar la penalización
                    $resultado = 'Incorrecta';
                }
            } else {
                // Si no se respondió, no suma ni resta puntos
                RespuestasAlumno::create([
                    'pregunta_id' => $pregunta->id,
                    'usuario_dni' => Auth::user()->DNI,
                    'opcion_respuesta_id' => null, // Sin respuesta
                ]);
                $resultado = 'Sin responder';
            }
    
            // Almacenar el resultado de esta pregunta
            $resultados[] = [
                'pregunta' => $pregunta->enunciado,
                'respuesta_usuario' => $respuesta_usuario ? $opcion->respuesta : 'Sin responder',
                'resultado' => $resultado,
            ];
        }
    
        // Asegurarse de que la puntuación no sea negativa
        $puntuacion = max(0, $puntuacion);
    
        // Actualizar los puntos del usuario
        $usuario = Auth::user(); // Obtener el usuario autenticado
    
        if ($usuario instanceof Usuario) { // Asegurarse de que $usuario sea una instancia de Usuario
            $usuario->puntos += $puntuacion; // Sumar la puntuación obtenida al atributo 'puntos'
            $usuario->save(); // Guardar los cambios en la base de datos
        } else {
            return redirect()->back()->with('error', 'No se pudo actualizar la puntuación del usuario.');
        }
    
        // Pasar los resultados y la puntuación a la vista
        return view('tareas.resultado', compact('resultados', 'puntuacion', 'aciertos', 'total_preguntas', 'curso', 'tarea'));
    }
    public function mostrarResultados($curso_id, $tarea_id)
    {
        // Obtener el curso y la tarea
        $curso = Curso::findOrFail($curso_id);
        $tarea = Tarea::findOrFail($tarea_id);
    
        // Obtener las respuestas del usuario para esta tarea
        $respuestasUsuario = RespuestasAlumno::where('usuario_dni', Auth::user()->DNI)
            ->whereIn('pregunta_id', $tarea->preguntas->pluck('id'))
            ->get();
    
        // Inicializar variables
        $resultados = [];
        $puntuacion = 0;
        $aciertos = 0;
        $total_preguntas = $tarea->preguntas->count();
        $valor_pregunta = 10 / $total_preguntas;
        $penalizacion = $valor_pregunta / 3;
    
        // Recorrer las preguntas de la tarea
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
    
        // Asegurarse de que la puntuación no sea negativa
        $puntuacion = max(0, $puntuacion);
    
        // Pasar los resultados a la vista
        return view('tareas.resultado', compact('resultados', 'puntuacion', 'aciertos', 'total_preguntas', 'curso', 'tarea'));
    }
    

}
   
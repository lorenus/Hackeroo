<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Tarea;
use App\Models\Curso;
use App\Models\Pregunta;
use App\Models\OpcionesRespuesta;
use App\Models\RecursoMultimedia;
use App\Models\RespuestasAlumno;
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


            // Redirigir incluyendo el ID de la tarea recién creada
            return redirect()->route('tarea.test.create', ['curso_id' => $request->curso_id, 'tarea_id' => $tarea->id]);
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
    public function crearTest($curso_id, $tarea_id)
    {
        // Obtener la tarea específica por su ID
        $tarea = Tarea::findOrFail($tarea_id);

        // Obtener el número de preguntas de la sesión
        $numero_preguntas = Session::get('numero_preguntas', 5); // Valor predeterminado si no existe

        return view('tareas.configurar-test', compact('tarea', 'curso_id', 'numero_preguntas'));
    }
    public function guardarTest(Request $request, $curso_id, $tarea_id)
    {
        // Obtener la tarea específica por su ID
        $tarea = Tarea::findOrFail($tarea_id);

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
    $curso = Curso::findOrFail($curso_id);
    $tarea = Tarea::findOrFail($tarea_id);
    $usuario = Auth::user(); // Obtener el usuario autenticado

    $resultados = [];

    if (!Auth::check()) { // Verifica *primero* si el usuario está autenticado
        return redirect()->route('login')->with('error', 'Debes iniciar sesión para responder.');
    }

    foreach ($tarea->preguntas as $pregunta) {
        $respuesta_usuario = $request->input('pregunta.' . $pregunta->id);

        if ($respuesta_usuario) {
            $opcion = $pregunta->opciones_respuestas()->find($respuesta_usuario);

            // Crear el registro en respuestas_alumnos *dentro* del if
            $respuesta = new RespuestasAlumno(); // Instancia el modelo
            $respuesta->usuario_dni = $usuario->DNI; // Asigna el DNI *después* de la verificación
            $respuesta->pregunta_id = $pregunta->id;
            $respuesta->opcion_respuesta_id = $opcion->id;
            $respuesta->save(); // Guarda el modelo

            $es_correcta = $opcion->es_correcta;

            $resultados[] = [
                'pregunta' => $pregunta->enunciado,
                'respuesta_usuario' => $opcion->respuesta,
                'respuesta_correcta' => $es_correcta ? 'Correcta' : 'Incorrecta',
                'acertada' => $es_correcta
            ];
        }
    }

        // Calcular el puntaje (si lo deseas mostrar)
        $aciertos = count(array_filter($resultados, fn($resultado) => $resultado['acertada']));
        $total = count($tarea->preguntas);

        // Pasar los resultados a la vista para mostrar al usuario
        return view('tareas.resultado', compact('resultados', 'aciertos', 'total', 'curso', 'tarea'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Usuario;
use App\Models\Curso;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\RespuestasAlumno;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function index(Request $request)
    {
        return view('perfil', [
            'user' => $request->user(),
        ]);
    }

    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
{
    // Validación de los campos
    $validated = $request->validate([
        'color' => 'nullable|string|max:7',
        'avatar' => 'nullable|string' // Valida que sea una cadena (el nombre del archivo)
    ]);
    $user = $request->user();

     // Actualizar el avatar (directamente desde el input validado)
if(isset($request->avatar)){
    $user->avatar = $validated['avatar'];
}
   // Actualizar el color
if(isset($request->color)){
    $user->color = $validated['color'];
}
   
    

   
    

    // Guardar los cambios
    $user->save();

    // Redireccionar
    return redirect()->route('perfil')->with('success', 'Perfil actualizado correctamente.');

}

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
 
    public function verAlumnos()
    {
        if (Auth::check() && Auth::user()->rol === 'profesor') {
            $cursos = Auth::user()->cursos_profesor; // Cursos del profesor
    
            // Crear una colección para almacenar los datos de alumnos por curso
            $alumnosPorCurso = [];
    
            foreach ($cursos as $curso) {
                $alumnosDelCurso = $curso->alumnos; // Alumnos inscritos en este curso
    
                foreach ($alumnosDelCurso as $alumno) {
                    // Contar las tareas completadas por el alumno en este curso
                    $tareasCompletadas = RespuestasAlumno::where('usuario_dni', $alumno->DNI)
                        ->whereIn('pregunta_id', function ($query) use ($curso) {
                            $query->select('id')
                                ->from('preguntas')
                                ->whereIn('tarea_id', $curso->tareas->pluck('id'));
                        })
                        ->distinct('pregunta_id') // Evitar duplicados
                        ->count();
    
                    // Agregar los datos al arreglo
                    $alumnosPorCurso[] = [
                        'alumno' => $alumno,
                        'curso' => $curso,
                        'tareas_completadas' => $tareasCompletadas,
                    ];
                }
            }
    
            return view('profile.alumnos', compact('alumnosPorCurso'));
        }
    
        return abort(403, 'No tienes permiso para acceder a esta página.');
    }

   
    
    public function verAlumnoEnCurso($alumnoDNI, $curso_id)
{
    // Obtener el curso y el alumno
    $curso = Curso::findOrFail($curso_id);
    $alumno = Usuario::where('DNI', $alumnoDNI)->firstOrFail();

    // Obtener solo las tareas de tipo "test" del curso
    $tareasDelCurso = $curso->tareas()->where('tipo', 'test')->get();

    // Inicializar un arreglo para almacenar los resultados
    $resultadosTareas = [];

    foreach ($tareasDelCurso as $tarea) {
        // Obtener las respuestas del alumno para esta tarea
        $respuestasUsuario = RespuestasAlumno::where('usuario_dni', $alumnoDNI)
            ->whereIn('pregunta_id', $tarea->preguntas->pluck('id'))
            ->get();

        if ($respuestasUsuario->isNotEmpty()) {
            // Calcular la nota de la tarea
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
                    } else {
                        $puntuacion -= $penalizacion;
                    }
                }
            }

            // Asegurarse de que la puntuación no sea negativa
            $puntuacion = max(0, $puntuacion);

            $resultadosTareas[] = [
                'tarea' => $tarea,
                'nota' => number_format($puntuacion, 2),
            ];
        } else {
            // Si no hay respuestas, marcar como "No completada"
            $resultadosTareas[] = [
                'tarea' => $tarea,
                'nota' => 'No completada',
            ];
        }
    }

    // Si no hay tareas de tipo test, enviar un mensaje
    if ($tareasDelCurso->isEmpty()) {
        return view('profile.alumno', compact('alumno', 'curso'))->with('noTareas', true);
    }

    return view('profile.alumno', compact('alumno', 'curso', 'resultadosTareas'));
}


}
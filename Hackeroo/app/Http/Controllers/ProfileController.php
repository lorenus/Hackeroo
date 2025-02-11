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
    $validated = $request->validate([
        'color' => 'nullable|string|max:7',
        'avatar' => 'nullable|string' 
    ]);
    $user = $request->user();

if(isset($request->avatar)){
    $user->avatar = $validated['avatar'];
}
if(isset($request->color)){
    $user->color = $validated['color'];
}
   
    

   
    

    $user->save();

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
        $cursos = Auth::user()->cursos_profesor;

        $alumnosPorCurso = [];

        foreach ($cursos as $curso) {
            $alumnosDelCurso = $curso->alumnos;

            foreach ($alumnosDelCurso as $alumno) {
                // Check if the alumno is already in the array (to avoid duplicates)
                $alumnoKey = $alumno->DNI; // Use DNI as a unique key for the alumno

                if (!isset($alumnosPorCurso[$alumnoKey])) {
                    $alumnosPorCurso[$alumnoKey] = [
                        'alumno' => $alumno,
                        'cursos' => [], // Initialize an array for the alumno's courses
                    ];
                }

                $tareasCompletadas = RespuestasAlumno::where('usuario_dni', $alumno->DNI)
                    ->whereIn('pregunta_id', function ($query) use ($curso) {
                        $query->select('id')
                            ->from('preguntas')
                            ->whereIn('tarea_id', $curso->tareas->pluck('id'));
                    })
                    ->distinct('pregunta_id')
                    ->pluck('pregunta_id')
                    ->map(function ($preguntaId) use ($curso) {
                        return $curso->tareas->filter(function ($tarea) use ($preguntaId) {
                            return $tarea->preguntas->pluck('id')->contains($preguntaId);
                        })->unique('id');
                    })
                    ->collapse()
                    ->unique('id')
                    ->count();

                $alumnosPorCurso[$alumnoKey]['cursos'][] = [
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

    $curso = Curso::findOrFail($curso_id);
    $alumno = Usuario::where('DNI', $alumnoDNI)->firstOrFail();

    $tareasDelCurso = $curso->tareas()->where('tipo', 'test')->get();

    $resultadosTareas = [];

    foreach ($tareasDelCurso as $tarea) {
        $respuestasUsuario = RespuestasAlumno::where('usuario_dni', $alumnoDNI)
            ->whereIn('pregunta_id', $tarea->preguntas->pluck('id'))
            ->get();

        if ($respuestasUsuario->isNotEmpty()) {
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

            $puntuacion = max(0, $puntuacion);

            $resultadosTareas[] = [
                'tarea' => $tarea,
                'nota' => number_format($puntuacion, 2),
            ];
        } else {
            $resultadosTareas[] = [
                'tarea' => $tarea,
                'nota' => 'No completada',
            ];
        }
    }

    if ($tareasDelCurso->isEmpty()) {
        return view('profile.alumno', compact('alumno', 'curso'))->with('noTareas', true);
    }

    return view('profile.alumno', compact('alumno', 'curso', 'resultadosTareas'));
}


}
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

class ProfileController extends Controller
{
  

     public function index()
     {
         // Puedes pasar el usuario a la vista si lo necesitas
         return view('perfil', ['user' => Auth::user()]);
     }
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        // Validación de los campos
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:usuarios,email,' . Auth::user()->DNI . ',DNI',
        ]);

        // Actualizamos los datos del usuario
        $user = $request->user();
        $user->update($validated);

        // Si el email fue cambiado, marcamos el email como no verificado
        if ($request->has('email') && $user->isDirty('email')) {
            $user->email_verified_at = null;  // Restablecer la verificación del email
        }

        // Guardar los cambios
        $user->save();

        // Redirigir a la ruta correcta según el rol del usuario
        if ($user->rol === 'profesor') {
            return redirect()->route('profesor.index')->with('status', 'Perfil actualizado correctamente.');
        } else {
            return redirect()->route('alumno.index')->with('status', 'Perfil actualizado correctamente.');
        }
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
            $alumnos = $cursos->pluck('alumnos')->flatten()->unique('DNI');
            return view('profile.alumnos', compact('alumnos'));
        }
        return abort(403, 'No tienes permiso para acceder a esta página.');
    }

    public function verAlumno($dni)
    {
        $alumno = Usuario::where('dni', $dni)->firstOrFail();
        return view('profile.alumno', compact('alumno'));
    }

    public function alumnoPage()
    {
        // Verificar si el usuario está autenticado y es un alumno
        if (Auth::check() && Auth::user()->rol === 'alumno') {
            // Obtener los cursos asociados al alumno logueado
            $cursos = Auth::user()->cursos;  // Esto es posible gracias a la relación definida en el modelo Usuario

            return view('profile.alumno', compact('cursos')); // Pasamos los cursos a la vista
        }

        // Si no es alumno, redirigir o abortar con un error 403
        return abort(403, 'No tienes permiso para acceder a esta página.');
    }
    public function alumnoCursos()
    {   
        $user = Auth::user();
        $cursos = $user->cursos;

        return view('profile.alumno_cursos', compact('cursos'));
    }
    public function verCursos()
    {
        // Verificar si el usuario está autenticado y es un alumno
        if (Auth::check() && Auth::user()->rol === 'alumno') {
            // Obtener los cursos asociados al alumno logueado
            $cursos = Auth::user()->cursos;  // Esto es posible gracias a la relación definida en el modelo Usuario

            return view('profile.alumno_cursos', compact('cursos')); // Pasamos los cursos a la vista
        }

        // Si no es alumno, redirigir o abortar con un error 403
        return abort(403, 'No tienes permiso para acceder a esta página.');
    }
}

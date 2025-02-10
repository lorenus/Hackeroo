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
    /**
     * Display the user's profile form.
     */
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
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:usuarios,email,' . Auth::user()->DNI . ',DNI',
            'color' => 'required|string|max:7', // Validación de color (formato hexadecimal)
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Imagen opcional
        ]);

        // Obtener el usuario autenticado
        $user = $request->user();

        // Si hay una nueva imagen, procesarla
        if ($request->hasFile('avatar')) {
            // Guardar la imagen en la carpeta 'avatars' dentro del almacenamiento
            $path = $request->file('avatar')->store('avatares', 'public');

            // Asignar la nueva ruta al usuario
            $user->avatar = $path;
        }

        // Actualizar los datos del usuario
        $user->fill($validated);

        // Si el email fue cambiado, marcarlo como no verificado
        if ($request->has('email') && $user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Guardar los cambios
        $user->save();

        // Redirigir según el rol del usuario
        return redirect()->route($user->rol === 'profesor' ? 'profesor.index' : 'alumno.index')
            ->with('status', 'Perfil actualizado correctamente.');
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
    public function profesorPage()
    {
        // Verificar si el usuario está autenticado y es un profesor
        if (Auth::check() && Auth::user()->rol === 'profesor') {
            // Obtener los cursos del profesor logueado, con la relación 'alumnos'
            $cursos = Auth::user()->cursos_profesor()->with('alumnos')->get();
            // Obtener todos los alumnos asociados a esos cursos
            $alumnos = $cursos->pluck('alumnos')->flatten()->unique('DNI');

            return view('profile.profesor', compact('alumnos')); // Pasamos los alumnos a la vista
        }

        // Si no es profesor, redirigir o abortar con un error 403
        return abort(403, 'No tienes permiso para acceder a esta página.');
    }
    // app/Http/Controllers/ProfileController.php

    public function verAlumnos()
    {
        if (Auth::check() && Auth::user()->rol === 'profesor') {
            $cursos = Auth::user()->cursos_profesor()->with('alumnos')->get();
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
        if (Auth::check() && Auth::user()->rol === 'alumno') {
            // Obtener todos los cursos en los que está inscrito el alumno
            $cursos = Auth::user()->cursos()->get(); // Asegúrate de que 'cursos' esté definido correctamente en el modelo de Usuario
            return view('profile.alumno_cursos', compact('cursos'));
        }
        return abort(403, 'No tienes permiso para acceder a esta página.');
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

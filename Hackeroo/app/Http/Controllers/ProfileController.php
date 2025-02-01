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
            'email' => 'required|email|max:255|unique:usuarios,email,' . Auth::user()->DNI . ',DNI', // Aquí usamos `DNI` en lugar de `id`
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

        // Redirigir al perfil con un mensaje de éxito
        return redirect()->route('profile.edit')->with('status', 'profile-updated');
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
}

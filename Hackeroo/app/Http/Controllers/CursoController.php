<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CursoController extends Controller
{
    // Mostrar el formulario para crear el curso (Paso 1: Nombre y Descripción)
    public function step1()
    {
        // Verificar si el usuario está autenticado y es un profesor
        if (Auth::check() && Auth::user()->rol === 'profesor') {
            return view('cursos.create_step1'); // vista para ingresar nombre y descripción
        }

        // Si no es profesor, redirigir o abortar con un error 403
        return abort(403, 'No tienes permiso para acceder a esta página.');
    }

    // Almacenar el nombre y descripción del curso (Paso 1)
    public function storeStep1(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
        ]);

        // Guardar los datos en la sesión
        Session::put('curso.nombre', $request->nombre);
        Session::put('curso.descripcion', $request->descripcion);

        // Redirigir al paso 2 (selección de alumnos)
        return redirect()->route('cursos.create.step2');
    }

    // Mostrar el formulario para seleccionar los alumnos (Paso 2)
    public function step2()
    {
        // Verificar si el usuario está autenticado y es un profesor
        if (Auth::check() && Auth::user()->rol === 'profesor') {
            // Obtener todos los alumnos
            $alumnos = Usuario::where('rol', 'alumno')->get();
            return view('cursos.create_step2', compact('alumnos')); // vista para seleccionar los alumnos
        }

        // Si no es profesor, redirigir o abortar con un error 403
        return abort(403, 'No tienes permiso para acceder a esta página.');
    }

    // Almacenar los alumnos seleccionados en el curso (Paso 2)
    public function storeStep2(Request $request)
    {
        // Validar los alumnos seleccionados
        $request->validate([
            'alumnos' => 'required|array',
            'alumnos.*' => 'exists:usuarios,DNI', // Verificar que los alumnos existen
        ]);

        // Crear el curso con los datos de la sesión
        $curso = Curso::create([
            'nombre' => Session::get('curso.nombre'),
            'descripcion' => Session::get('curso.descripcion'),
            'profesor_dni' => Auth::user()->DNI,
        ]);

        // Asociar los alumnos seleccionados al curso
        $curso->alumnos()->attach($request->alumnos);

        // Limpiar los datos de la sesión
        Session::forget('curso');

        // Redirigir con mensaje de éxito
        return redirect()->route('cursos.create.step1')->with('success', 'Curso creado correctamente.');
    }
}


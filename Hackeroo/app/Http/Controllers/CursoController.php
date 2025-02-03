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
    public function index()
    {
        // Verificar si el usuario está autenticado y es un profesor
        if (Auth::check() && Auth::user()->rol === 'profesor') {
            // Obtener los cursos del profesor logueado
            $cursos = Curso::where('profesor_dni', Auth::user()->DNI)->get();
            return view('cursos.index', compact('cursos')); // Vista para mostrar los cursos
        }

        // Si no es profesor, redirigir o abortar con un error 403
        return abort(403, 'No tienes permiso para acceder a esta página.');
    }
    public function indexForAlumnos()
    {
        // Verificar si el usuario está autenticado y es un alumno
        if (Auth::check() && Auth::user()->rol === 'alumno') {
            // Obtener los cursos en los que el alumno está inscrito
            $cursos = Auth::user()->cursos;  // Suponiendo que tienes una relación `cursos()` en el modelo Usuario

            // Retornar la vista con los cursos del alumno
            return view('cursos.index_alumno', compact('cursos'));
        }

        // Si no es alumno, redirigir o abortar con un error 403
        return abort(403, 'No tienes permiso para acceder a esta página.');
    }

    public function edit(Curso $curso)
    {
        // Verificar que el curso pertenece al profesor logueado
        if (Auth::check() && Auth::user()->DNI === $curso->profesor_dni) {
            // Obtener todos los alumnos disponibles
            $alumnos = Usuario::where('rol', 'alumno')->get();

            return view('cursos.edit', compact('curso', 'alumnos')); // Pasar el curso y los alumnos a la vista
        }

        // Si no es el profesor del curso, redirigir o abortar con un error 403
        return abort(403, 'No tienes permiso para editar este curso.');
    }


    public function update(Request $request, Curso $curso)
    {
        // Verificar que el curso pertenece al profesor logueado
        if (Auth::check() && Auth::user()->DNI === $curso->profesor_dni) {
            // Validar los datos del formulario
            $request->validate([
                'nombre' => 'required|string|max:255',
                'descripcion' => 'required|string',
                'alumnos' => 'required|array', // Asegurarse de que los alumnos sean un arreglo
                'alumnos.*' => 'exists:usuarios,DNI', // Validar que los alumnos existan
            ]);

            // Actualizar el curso
            $curso->update([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
            ]);

            // Actualizar la relación de alumnos
            // Primero, eliminamos los alumnos previamente asignados
            $curso->alumnos()->sync($request->alumnos); // Esto reemplaza la lista de alumnos por la nueva selección

            // Redirigir con mensaje de éxito
            return redirect()->route('cursos.index')->with('success', 'Curso actualizado correctamente.');
        }

        // Si no es el profesor del curso, redirigir o abortar con un error 403
        return abort(403, 'No tienes permiso para actualizar este curso.');
    }

    public function destroy(Curso $curso)
    {
        // Verificar que el curso pertenece al profesor logueado
        if (Auth::check() && Auth::user()->DNI === $curso->profesor_dni) {
            // Eliminar el curso
            $curso->delete();

            // Redirigir con mensaje de éxito
            return redirect()->route('cursos.index')->with('success', 'Curso eliminado correctamente.');
        }

        // Si no es el profesor del curso, redirigir o abortar con un error 403
        return abort(403, 'No tienes permiso para eliminar este curso.');
    }
}

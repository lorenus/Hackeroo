<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CursoController extends Controller
{
    // Mostrar el formulario para crear un curso
    public function create()
{
    // Verificar si el usuario está autenticado y tiene el rol de 'profesor'
    if (Auth::check() && Auth::user()->rol === 'profesor') {
        // Obtener todos los profesores y alumnos
        $profesores = Usuario::where('rol', 'profesor')->get();
        $alumnos = Usuario::where('rol', 'alumno')->get(); // Obtener los alumnos registrados

        return view('cursos.create', compact('profesores', 'alumnos'));
    }

    // Si no es profesor, redirigir o abortar con un error 403
    return abort(403, 'No tienes permiso para acceder a esta página.');
}

    // Guardar el curso en la base de datos
    public function store(Request $request)
{
    // Validar los datos del formulario
    $request->validate([
        'nombre' => 'required|string|max:255',
        'descripcion' => 'required|string',
        'alumnos' => 'required|array', // Validación de los alumnos seleccionados
        'alumnos.*' => 'exists:usuarios,DNI' // Asegurarse de que los alumnos existen
    ]);

    // Crear el curso
    $curso = Curso::create([
        'nombre' => $request->nombre,
        'descripcion' => $request->descripcion,
        'profesor_dni' => Auth::user()->DNI,
    ]);

    // Asociar los alumnos seleccionados al curso
    $curso->alumnos()->attach($request->alumnos);

    // Redirigir con éxito
    return redirect()->route('cursos.create')->with('success', 'Curso creado correctamente.');
}

}

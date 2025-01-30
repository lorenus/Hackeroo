<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Usuarios;
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
        $profesores = Usuarios::where('rol', 'profesor')->get();
        $alumnos = Usuarios::where('rol', 'alumno')->get(); // Obtener los alumnos registrados

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
            'descripcion' => 'required|string', // Asegurarse de que el profesor exista
        ]);

        // Crear el curso
        Curso::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'profesor_dni' => Auth::user()->DNI,
        ]);

        // Redirigir con éxito
        return redirect()->route('cursos.create')->with('success', 'Curso creado correctamente.');
    }
}

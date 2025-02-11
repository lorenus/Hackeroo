<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CursoController extends Controller
{
    public function step1()
    {
        if (Auth::check() && Auth::user()->rol === 'profesor') {
            return view('cursos.create_step1'); 
        }

        return abort(403, 'No tienes permiso para acceder a esta página.');
    }

    public function storeStep1(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
        ]);

        Session::put('curso.nombre', $request->nombre);
        Session::put('curso.descripcion', $request->descripcion);

        return redirect()->route('cursos.create.step2');
    }

    public function step2()
    {
        if (Auth::check() && Auth::user()->rol === 'profesor') {
            $alumnos = Usuario::where('rol', 'alumno')->get();
            return view('cursos.create_step2', compact('alumnos')); 
        }

        return abort(403, 'No tienes permiso para acceder a esta página.');
    }

    public function storeStep2(Request $request)
    {
        $request->validate([
            'alumnos' => 'required|array',
            'alumnos.*' => 'exists:usuarios,DNI', 
        ]);

        $curso = Curso::create([
            'nombre' => Session::get('curso.nombre'),
            'descripcion' => Session::get('curso.descripcion'),
            'profesor_dni' => Auth::user()->DNI,
        ]);

        $curso->alumnos()->attach($request->alumnos);

        Session::forget('curso');

        return redirect()->route('cursos')->with('status', 'Curso creado correctamente.');
    }


    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login'); 
        }

        if (Auth::user()->rol !== 'profesor') {
            return abort(403, 'No tienes permiso para acceder a esta página.');
        }

        $cursos = Curso::where('profesor_dni', Auth::user()->DNI)->get();


        return view('cursos.index', compact('cursos'));
    }
    public function indexForAlumnos()
    {
        if (Auth::check() && Auth::user()->rol === 'alumno') {
            $cursos = Auth::user()->cursos; 

            return view('cursos.index_alumno', compact('cursos'));
        }

        return abort(403, 'No tienes permiso para acceder a esta página.');
    }

    public function edit(Curso $curso)
    {
        if (Auth::check() && Auth::user()->DNI === $curso->profesor_dni) {
            $alumnos = Usuario::where('rol', 'alumno')->get();
    
            $cursos_alumnos = $curso->alumnos()->pluck('DNI');
    
            return view('cursos.edit', compact('curso', 'alumnos', 'cursos_alumnos'));
        }
    
        return abort(403, 'No tienes permiso para editar este curso.');
    }


    public function update(Request $request, Curso $curso)
    {
        if (Auth::check() && Auth::user()->DNI === $curso->profesor_dni) {
            $request->validate([
                'nombre' => 'required|string|max:255',
                'descripcion' => 'required|string',
                'alumnos' => 'required|array', 
                'alumnos.*' => 'exists:usuarios,DNI', 
            ]);

            $curso->update([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
            ]);

            $curso->alumnos()->sync($request->alumnos); 

            return redirect()->route('cursos')->with('status', 'Curso actualizado correctamente.');
        }

        return abort(403, 'No tienes permiso para actualizar este curso.');
    }

    public function destroy(Curso $curso)
    {
        if (Auth::check() && Auth::user()->DNI === $curso->profesor_dni) {
            $curso->delete();

            return redirect()->route('cursos')->with('success', 'Curso eliminado correctamente.');
        }

        return abort(403, 'No tienes permiso para eliminar este curso.');
    }
    public function show($id)
    {

        $curso = Curso::with('tareas')->findOrFail($id);


        if ($curso->profesor_dni !== Auth::user()->DNI) {
            return abort(403, 'No tienes permiso para ver este curso.');
        }


        return view('cursos.show', compact('curso'));
    }
    public function showAlumno($id)
    {
        $curso = Curso::findOrFail($id);


        $tareas = $curso->tareas; 

        return view('cursos.show_alumno', compact('curso', 'tareas'));
    }
}

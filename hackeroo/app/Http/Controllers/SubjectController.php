<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;

class SubjectController extends Controller
{
    // Lista todas las asignaturas
    public function index()
    {
        $subjects = Subject::all();
        return response()->json($subjects);
    }

    // Crea una nueva asignatura
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $subject = Subject::create([
            'name' => $request->name,
        ]);

        return response()->json(['message' => 'Subject created successfully', 'subject' => $subject], 201);
    }

    // Actualiza una asignatura
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $subject = Subject::findOrFail($id);
        $subject->update(['name' => $request->name]);

        return response()->json(['message' => 'Subject updated successfully', 'subject' => $subject], 200);
    }

    // Elimina una asignatura
    public function destroy($id)
    {
        $subject = Subject::findOrFail($id);
        $subject->delete();

        return response()->json(['message' => 'Subject deleted successfully'], 200);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exercise;

class ExerciseController extends Controller
{
    // Lista todos los ejercicios de una asignatura
    public function index($subjectId)
    {
        $exercises = Exercise::where('subject_id', $subjectId)->get();
        return response()->json($exercises);
    }

    // Crea un nuevo ejercicio
    public function create(Request $request, $subjectId)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $exercise = Exercise::create([
            'subject_id' => $subjectId,
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return response()->json(['message' => 'Exercise created successfully', 'exercise' => $exercise], 201);
    }

    // Actualiza un ejercicio
    public function update(Request $request, $id)
    {
        $exercise = Exercise::findOrFail($id);

        $exercise->update($request->only(['title', 'description']));

        return response()->json(['message' => 'Exercise updated successfully', 'exercise' => $exercise], 200);
    }

    // Elimina un ejercicio
    public function destroy($id)
    {
        $exercise = Exercise::findOrFail($id);
        $exercise->delete();

        return response()->json(['message' => 'Exercise deleted successfully'], 200);
    }
}

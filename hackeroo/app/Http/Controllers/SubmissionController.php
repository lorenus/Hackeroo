<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Submission;

class SubmissionController extends Controller
{
    // Lista las entregas de un ejercicio
    public function index($exerciseId)
    {
        $submissions = Submission::where('exercise_id', $exerciseId)->get();
        return response()->json($submissions);
    }

    // Crea una nueva entrega
    public function store(Request $request)
    {
        $request->validate([
            'exercise_id' => 'required|exists:exercises,id',
        ]);

        $submission = Submission::create([
            'user_id' => auth()->id(),
            'exercise_id' => $request->exercise_id,
        ]);

        return response()->json(['message' => 'Submission created successfully', 'submission' => $submission], 201);
    }
}

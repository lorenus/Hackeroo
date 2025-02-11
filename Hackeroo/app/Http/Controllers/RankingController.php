<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class RankingController extends Controller
{
    public function index()
    {
        // Obtener los usuarios que sean alumnos y ordenarlos por puntos de mayor a menor
        $usuarios = Usuario::where('rol', 'alumno')->orderBy('puntos', 'desc')->get();

        return view('ranking.index', compact('usuarios'));
    }
}

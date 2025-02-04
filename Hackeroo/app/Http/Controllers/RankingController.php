<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class RankingController extends Controller
{
    public function index()
    {
        // Obtener solo los usuarios con rol de "alumno" ordenados por puntos
        $usuarios = Usuario::where('rol', 'alumno')->orderBy('puntos', 'desc')->get();

        return view('ranking.index', compact('usuarios'));
    }
}

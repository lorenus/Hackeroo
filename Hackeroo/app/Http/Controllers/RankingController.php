<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class RankingController extends Controller
{
    public function index()
    {
        // Obtener los usuarios (alumnos) ordenados por el campo 'puntos' de mayor a menor
        $usuarios = Usuario::orderBy('puntos', 'desc')->get();

        // Retornar la vista con los usuarios
        return view('ranking.index', compact('usuarios'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerfilController extends Controller
{
    public function index()
    {
        // Puedes pasar el usuario a la vista si lo necesitas
        return view('perfil', ['user' => Auth::user()]);
    }
}
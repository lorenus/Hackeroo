<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaginasEstaticasController extends Controller
{
    public function index()
    {
        return view('home'); // Esto va a buscar una vista llamada 'home.blade.php'
    }

    public function faq(){
        return view('faq'); // Esto va a buscar una vista llamada 'home.blade.php'

    }
    public function info()
    {
        return view('info'); // Esto va a buscar una vista llamada 'home.blade.php'
    }
}

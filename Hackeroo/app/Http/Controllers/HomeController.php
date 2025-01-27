<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home'); // Esto va a buscar una vista llamada 'home.blade.php'
    }
}

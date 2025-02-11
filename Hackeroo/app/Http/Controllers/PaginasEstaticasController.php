<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaginasEstaticasController extends Controller
{
    public function index()
    {
        return view('home'); 
    }

    public function faq(){
        return view('faq'); 

    }
    public function info()
    {
        return view('info'); 
    }
}

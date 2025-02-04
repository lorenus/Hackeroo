<?php
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\PaginasEstaticasController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\CursoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;



// Route::get('/', function () {return view('welcome');});
// routes/web.php

Route::get('/', [PaginasEstaticasController::class, 'index'])->name('home'); 
Route::get('/info', [PaginasEstaticasController::class, 'info'])->name('info'); 
Route::get('/faq', [PaginasEstaticasController::class, 'faq'])->name('faq'); 

Route::get('/contacto', [ContactoController::class, 'contacto'])->name('contacto'); 

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile-edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile-update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile-destroy');
});

Route::middleware('auth')->get('/perfil', [PerfilController::class, 'index'])->name('perfil');


//CURSOS
Route::get('/cursos', [CursoController::class, 'index'])->name('cursos-index');



require __DIR__.'/auth.php';




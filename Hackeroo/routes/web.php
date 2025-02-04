<?php
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\PaginasEstaticasController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PerfilController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\TareaController;

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
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->get('/perfil', [PerfilController::class, 'index'])->name('perfil');

Route::get('/cursos/{id}', [CursoController::class, 'show'])->name('cursos.show');


Route::get('/tareas/{curso_id}/crear', [TareaController::class, 'crear'])->name('tarea.test.create');

Route::post('/tareas/guardar', [TareaController::class, 'guardar'])->name('tarea.guardar');

// Rutas para configurar un test
Route::get('/tareas/{curso_id}/configurar-test', [TareaController::class, 'crearTest'])->name('tarea.test.create');
Route::post('/tareas/{curso_id}/guardar-test', [TareaController::class, 'guardarTest'])->name('tarea.test.store');

// Rutas para subir un archivo
Route::get('/tareas/{curso_id}/subir-archivo', [TareaController::class, 'crearArchivo'])->name('tarea.archivo.create');
Route::post('/tareas/{curso_id}/guardar-archivo', [TareaController::class, 'guardarArchivo'])->name('tarea.archivo.store');

// Rutas para agregar un link
Route::get('/tareas/{curso_id}/agregar-link', [TareaController::class, 'crearLink'])->name('tarea.link.create');
Route::post('/tareas/{curso_id}/guardar-link', [TareaController::class, 'guardarLink'])->name('tarea.link.store');

// Ruta para eliminar una tarea
Route::delete('/tareas/{id}', [TareaController::class, 'eliminar'])->name('tarea.eliminar');


require __DIR__.'/auth.php';




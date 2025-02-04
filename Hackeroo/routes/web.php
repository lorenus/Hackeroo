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


Route::get('/tareas/{curso_id}/crear', [TareaController::class, 'crear'])->name('tarea.create');

Route::post('/tareas/guardar', [TareaController::class, 'guardar'])->name('tarea.guardar');

// Rutas para  tests
Route::get('/tareas/{curso_id}/configurar-test', [TareaController::class, 'crearTest'])->name('tarea.test.create');
Route::post('/tareas/{curso_id}/guardar-test', [TareaController::class, 'guardarTest'])->name('tarea.test.guardar');
Route::get('/tareas/{curso_id}/editar-test/{tarea_id}', [TareaController::class, 'editarTest'])->name('tarea.test.edit');
Route::post('/tareas/{curso_id}/guardar-editar-test/{tarea_id}', [TareaController::class, 'guardarEditarTest'])->name('tarea.test.update');

// Rutas para  archivos
Route::get('/tareas/{curso_id}/subir-archivo', [TareaController::class, 'crearArchivo'])->name('tarea.archivo.create');
Route::post('/tareas/{curso_id}/guardar-archivo', [TareaController::class, 'guardarArchivo'])->name('tarea.archivo.guardar');
Route::get('/tareas/{curso_id}/editar-archivo/{tarea_id}', [TareaController::class, 'editarArchivo'])->name('tarea.archivo.edit');
Route::post('/tareas/{curso_id}/guardar-editar-archivo/{tarea_id}', [TareaController::class, 'guardarEditarArchivo'])->name('tarea.archivo.update');

// Rutas para links
Route::get('/tareas/{curso_id}/agregar-link', [TareaController::class, 'crearLink'])->name('tarea.link.create');
Route::post('/tareas/{curso_id}/guardar-link', [TareaController::class, 'guardarLink'])->name('tarea.link');
Route::get('/tareas/{curso_id}/editar-link/{tarea_id}', [TareaController::class, 'editarLink'])->name('tarea.link.edit');
Route::post('/tareas/{curso_id}/guardar-editar-link/{tarea_id}', [TareaController::class, 'guardarEditarLink'])->name('tarea.link.update');

// Ruta para eliminar una tarea
Route::delete('/tareas/{id}', [TareaController::class, 'eliminar'])->name('tarea.eliminar');


require __DIR__.'/auth.php';




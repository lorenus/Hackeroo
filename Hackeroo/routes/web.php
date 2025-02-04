<?php
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\PaginasEstaticasController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\CursoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\RankingController;



// Route::get('/', function () {return view('welcome');});
// routes/web.php

Route::get('/', [PaginasEstaticasController::class, 'index'])->name('home'); 
Route::get('/info', [PaginasEstaticasController::class, 'info'])->name('info'); 
Route::get('/faq', [PaginasEstaticasController::class, 'faq'])->name('faq'); 

Route::get('/contacto', [ContactoController::class, 'contacto'])->name('contacto'); 

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->get('/perfil', [PerfilController::class, 'index'])->name('perfil'); //perfil


//TAREAS
Route::get('/configurar-test', [TareaController::class, 'crearTest'])->name('tarea.test.create');
Route::post('/configurar-test', [TareaController::class, 'guardarTest'])->name('tarea.test.store');

//PERFIL
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('editar-perfil'); //pagina de editar peril
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update'); //update el perfil
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); //elimina el perfil
});

//CURSOS PROFESOR
Route::get('cursos/{curso}/edit', [CursoController::class, 'edit'])->name('cursos.edit'); //vista de editar curso
Route::put('cursos/{curso}', [CursoController::class, 'update'])->name('cursos.update');
Route::delete('cursos/{curso}', [CursoController::class, 'destroy'])->name('cursos.destroy');
Route::middleware('auth')->group(function () {
    // Para profesores
    Route::get('/cursos', [CursoController::class, 'index'])->name('cursos'); //cursos del profesor
    // Para alumnos
    Route::get('/cursos/alumno', [CursoController::class, 'indexForAlumnos'])->name('cursos-alumno'); //cursos del alumno
});
Route::get('cursos/create/step1', [CursoController::class, 'step1'])->name('cursos.create.step1'); //primer paso de crear el curso (pagina)
Route::post('cursos/create/step1', [CursoController::class, 'storeStep1'])->name('cursos.store.step1'); //primer paso de crear el curso (post)
Route::get('cursos/create/step2', [CursoController::class, 'step2'])->name('cursos.create.step2'); //segundo paso de crear curso (pagina)
Route::post('cursos/create/step2', [CursoController::class, 'storeStep2'])->name('cursos.store.step2'); //segundo paso de crear curso (post)
Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update'); //updatea el curso

//PERFIL PROFESOR
Route::get('/profile/profesor', [ProfileController::class, 'profesorPage'])->middleware('auth')->name('profesor.index'); //perfil del profesor

// ALUMNOS PROFESOR
Route::get('/alumnos', [ProfileController::class, 'verAlumnos'])->name('alumnos'); //listado de alumnos del profesor


//ALUMNO
Route::get('/alumno/cursos', [ProfileController::class, 'verCursos'])->name('alumno.cursos'); //cursos del ALUMNO

//RANKING
Route::get('/ranking', [RankingController::class, 'index'])->name('ranking'); //pagina de rankings

require __DIR__.'/auth.php';




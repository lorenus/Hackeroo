<?php


use App\Http\Controllers\PaginasEstaticasController;
use App\Http\Controllers\ProfileController;
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

Route::get('/contacto', [PaginasEstaticasController::class, 'contacto'])->name('contacto');

Route::middleware('auth')->get('/perfil', [ProfileController::class, 'index'])->name('perfil'); //perfil

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
    Route::get('/cursos/{id}', [CursoController::class, 'show'])->name('cursos.show');
});
Route::get('cursos/create/step1', [CursoController::class, 'step1'])->name('cursos.create.step1'); //primer paso de crear el curso (pagina)
Route::post('cursos/create/step1', [CursoController::class, 'storeStep1'])->name('cursos.store.step1'); //primer paso de crear el curso (post)
Route::get('cursos/create/step2', [CursoController::class, 'step2'])->name('cursos.create.step2'); //segundo paso de crear curso (pagina)
Route::post('cursos/create/step2', [CursoController::class, 'storeStep2'])->name('cursos.store.step2'); //segundo paso de crear curso (post)
Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update'); //updatea el curso

// ALUMNOS PROFESOR
Route::get('/alumnos', [ProfileController::class, 'verAlumnos'])->name('alumnos'); //listado de alumnos del profesor
Route::get('/alumno-en-curso/{alumnoDNI}/{curso_id}', [ProfileController::class, 'verAlumnoEnCurso'])->name('ver.alumno.en.curso');

//ALUMNO
Route::get('/alumno/cursos', [ProfileController::class, 'verCursos'])->name('alumno.cursos'); //cursos del ALUMNO

//RANKING
Route::get('/ranking', [RankingController::class, 'index'])->name('ranking'); //pagina de rankingsRoute::get('/cursos/{id}', [CursoController::class, 'show'])->name('cursos.show');

//TAREAS
Route::get('/tareas/{curso_id}/crear', [TareaController::class, 'crear'])->name('tarea.create');

Route::post('/tareas/guardar', [TareaController::class, 'guardar'])->name('tarea.guardar');

Route::get('/tareas/test/crear/{curso_id}', [TareaController::class, 'crearTest'])->name('tarea.test.create');
Route::post('/tareas/test/guardar/{curso_id}', [TareaController::class, 'guardarTest'])->name('tarea.test.guardar');
Route::get('/tareas/{curso_id}/{tarea_id}/resultado', [TareaController::class, 'mostrarResultado'])->name('tarea.resultado');


// Ruta para eliminar una tarea
Route::delete('/tareas/{curso_id}/{tarea_id}', [TareaController::class, 'eliminar'])->name('tarea.eliminar');

Route::get('/cursos/{id}/alumno', [CursoController::class, 'showAlumno'])
    ->middleware('auth')
    ->name('cursos.show.alumno');


        // Ruta para mostrar el formulario de edición
Route::get('/tareas/{id}/editar-recurso', [TareaController::class, 'editRecurso'])->name('tareas.edit.recurso');
    
        // Ruta para procesar los cambios
Route::put('/tareas/{id}/actualizar-recurso', [TareaController::class, 'updateRecurso'])->name('tareas.update.recurso');


Route::post('/tareas/{curso_id}/{tarea_id}/responder', [TareaController::class, 'responder'])->name('tarea.responder');

Route::get('/curso/{curso_id}/tareas', [TareaController::class, 'mostrarTareas'])->name('curso.tareas');

Route::get('/curso/{curso_id}/tarea/{tarea_id}', [TareaController::class, 'verTarea'])->name('tarea.ver');

Route::post('/curso/{curso_id}/tarea/{tarea_id}/enviar', [TareaController::class, 'enviarRespuestas'])->name('tarea.enviar');

Route::get('/cursos/{curso_id}/tareas/{tarea_id}/resultados', [TareaController::class, 'mostrarResultados'])
    ->name('tarea.resultados');

    require __DIR__ . '/auth.php';
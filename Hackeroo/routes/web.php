<?php


use App\Http\Controllers\PaginasEstaticasController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CursoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\RankingController;


//PAGINAS ESTATICAS
Route::get('/', [PaginasEstaticasController::class, 'index'])->name('home');
Route::get('/info', [PaginasEstaticasController::class, 'info'])->name('info');
Route::get('/faq', [PaginasEstaticasController::class, 'faq'])->name('faq');
Route::get('/contacto', [PaginasEstaticasController::class, 'contacto'])->name('contacto');

//PERFIL
Route::middleware('auth')->group(function () {
    //Para profesor y alumno
    Route::get('/perfil', [ProfileController::class, 'index'])->name('perfil'); //pagina del perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('editar-perfil'); //pagina de editar peril
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update'); //update el perfil
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); //elimina el perfil
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update'); //Ruta para cambiar el icono y el color del perfil

    //Para profesor
    Route::get('/alumnos', [ProfileController::class, 'verAlumnos'])->name('alumnos'); //listado de alumnos del profesor en cada uno de sus cursos
    Route::get('/alumno-en-curso/{alumnoDNI}/{curso_id}', [ProfileController::class, 'verAlumnoEnCurso'])->name('ver.alumno.en.curso'); //Notas de un alumno en cada tarea de un curso de un profesor
});



//CURSOS
Route::middleware('auth')->group(function () {
    // Para profesores
    Route::get('/cursos', [CursoController::class, 'index'])->name('cursos'); //cursos del profesor
    Route::get('/cursos/{id}', [CursoController::class, 'show'])->name('cursos.show'); //Vista de cada curso en concreto

    Route::get('cursos/create/step1', [CursoController::class, 'step1'])->name('cursos.create.step1'); //primer paso de crear el curso (pagina)
    Route::post('cursos/create/step1', [CursoController::class, 'storeStep1'])->name('cursos.store.step1'); //primer paso de crear el curso (post)
    Route::get('cursos/create/step2', [CursoController::class, 'step2'])->name('cursos.create.step2'); //segundo paso de crear curso (pagina)
    Route::post('cursos/create/step2', [CursoController::class, 'storeStep2'])->name('cursos.store.step2'); //segundo paso de crear curso (post)

    Route::get('cursos/{curso}/edit', [CursoController::class, 'edit'])->name('cursos.edit'); //vista de editar curso
    Route::put('cursos/{curso}', [CursoController::class, 'update'])->name('cursos.update'); //Accion de editar el curso

    Route::delete('cursos/{curso}', [CursoController::class, 'destroy'])->name('cursos.destroy'); //Borrar el curso

    // Para alumnos
    Route::get('/cursos/alumno', [CursoController::class, 'indexForAlumnos'])->name('cursos-alumno'); //cursos del alumno   
    Route::get('/cursos/{id}/alumno', [CursoController::class, 'showAlumno'])->name('cursos.show.alumno'); //cada curso en concreto de alumno
});



//TAREAS
Route::middleware('auth')->group(function () {
    //Para profesores
    Route::get('/tareas/{curso_id}/crear', [TareaController::class, 'crear'])->name('tarea.create'); //Crear un archivo, link o inicializar el test
    Route::post('/tareas/guardar', [TareaController::class, 'guardar'])->name('tarea.guardar'); //Guardar archivo o link

    Route::get('/configurar-test', [TareaController::class, 'crearTest'])->name('tarea.test.create'); //Rellenar las preguntas y respuestas
    Route::post('/tareas/test/guardar/{curso_id}', [TareaController::class, 'guardarTest'])->name('tarea.test.guardar'); //Guardar preguntas y respuestas del test


    Route::get('/tareas/{id}/editar-recurso', [TareaController::class, 'editRecurso'])->name('tareas.edit.recurso'); //Ruta para cambiar el link o archivo
    Route::put('/tareas/{id}/actualizar-recurso', [TareaController::class, 'updateRecurso'])->name('tareas.update.recurso'); //Ruta para guardar el cambio del link o archivo

    Route::delete('/tareas/{curso_id}/{tarea_id}', [TareaController::class, 'eliminar'])->name('tarea.eliminar'); // Ruta para eliminar una tarea
    //Alumno
    Route::get('/curso/{curso_id}/tareas', [TareaController::class, 'mostrarTareas'])->name('curso.tareas'); //Mostrar las distintas tareas
    Route::get('/curso/{curso_id}/tarea/{tarea_id}', [TareaController::class, 'verTarea'])->name('tarea.ver'); //Mostrar una tarea(Abre link, descarga archivo o te muestra el test)
    Route::post('/curso/{curso_id}/tarea/{tarea_id}/enviar', [TareaController::class, 'enviarRespuestas'])->name('tarea.enviar'); //Mandar las respuestas del test, se procesan y te manda a la vista con las soluciones y nota
    Route::get('/cursos/{curso_id}/tareas/{tarea_id}/resultados', [TareaController::class, 'mostrarResultados'])->name('tarea.resultados'); //Cuando ya has respondido una test y le das a verlo

});

//RANKING
Route::get('/ranking', [RankingController::class, 'index'])->name('ranking'); //pagina de rankings para alumnos



















require __DIR__ . '/auth.php';

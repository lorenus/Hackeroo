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
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->get('/perfil', [PerfilController::class, 'index'])->name('perfil');



Route::get('/configurar-test', [TareaController::class, 'crearTest'])->name('tarea.test.create');
Route::post('/configurar-test', [TareaController::class, 'guardarTest'])->name('tarea.test.store');

Route::get('cursos/create/step1', [CursoController::class, 'step1'])->name('cursos.create.step1');
Route::post('cursos/create/step1', [CursoController::class, 'storeStep1'])->name('cursos.store.step1');

// Paso 2: Mostrar el formulario para seleccionar alumnos
Route::get('cursos/create/step2', [CursoController::class, 'step2'])->name('cursos.create.step2');
Route::post('cursos/create/step2', [CursoController::class, 'storeStep2'])->name('cursos.store.step2');
Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
// En routes/web.php

Route::middleware('auth')->group(function () {
    // Para profesores
    Route::get('/cursos', [CursoController::class, 'index'])->name('cursos');

    // Para alumnos
    Route::get('/cursos/alumno', [CursoController::class, 'indexForAlumnos'])->name('cursos.index.alumno');
});


Route::get('cursos/{curso}/edit', [CursoController::class, 'edit'])->name('cursos.edit');
Route::put('cursos/{curso}', [CursoController::class, 'update'])->name('cursos.update');
Route::delete('cursos/{curso}', [CursoController::class, 'destroy'])->name('cursos.destroy');
Route::get('/profile/profesor', [ProfileController::class, 'profesorPage'])->middleware('auth')->name('profesor.index');;
// routes/web.php
Route::get('/alumnos', [ProfileController::class, 'verAlumnos'])->name('alumnos');
Route::middleware(['auth'])->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});
// Ruta para la página del alumno
Route::get('/profile/alumno', [ProfileController::class, 'alumnoPage'])->middleware('auth')->name('alumno.index');
Route::get('/profile/alumno/cursos', [ProfileController::class, 'verCursos'])->name('alumno.cursos');

//ALUMNOS



require __DIR__.'/auth.php';




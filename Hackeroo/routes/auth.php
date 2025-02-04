<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\CursoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RankingController;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
        

    Route::get('cursos/create/step1', [CursoController::class, 'step1'])->name('cursos.create.step1');
    Route::post('cursos/create/step1', [CursoController::class, 'storeStep1'])->name('cursos.store.step1');

    // Paso 2: Mostrar el formulario para seleccionar alumnos
    Route::get('cursos/create/step2', [CursoController::class, 'step2'])->name('cursos.create.step2');
    Route::post('cursos/create/step2', [CursoController::class, 'storeStep2'])->name('cursos.store.step2');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    // En routes/web.php

    Route::middleware('auth')->group(function () {
        // Para profesores
        Route::get('/cursos', [CursoController::class, 'index'])->name('cursos.index');

        // Para alumnos
        Route::get('/cursos/alumno', [CursoController::class, 'indexForAlumnos'])->name('cursos.index.alumno');
    });


    Route::get('cursos/{curso}/edit', [CursoController::class, 'edit'])->name('cursos.edit');
    Route::put('cursos/{curso}', [CursoController::class, 'update'])->name('cursos.update');
    Route::delete('cursos/{curso}', [CursoController::class, 'destroy'])->name('cursos.destroy');
    Route::get('/profile/profesor', [ProfileController::class, 'profesorPage'])->middleware('auth')->name('profesor.index');;
    // routes/web.php
    Route::get('/alumnos', [ProfileController::class, 'verAlumnos'])->name('alumnos.ver');
    Route::middleware(['auth'])->group(function () {
        Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    });
    // Ruta para la página del alumno
    Route::get('/profile/alumno', [ProfileController::class, 'alumnoPage'])->middleware('auth')->name('alumno.index');
    Route::get('/profile/alumno/cursos', [ProfileController::class, 'verCursos'])->name('alumno.cursos');

    // Ruta para ver el ranking
    Route::get('/ranking', [RankingController::class, 'index'])->name('ranking');


});

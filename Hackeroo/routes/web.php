<?php
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\PaginasEstaticasController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;



// Route::get('/', function () {return view('welcome');});
// routes/web.php




Route::get('/', [PaginasEstaticasController::class, 'index']);
Route::get('/info', [PaginasEstaticasController::class, 'info']);
Route::get('/faq', [PaginasEstaticasController::class, 'faq']);

Route::get('/contacto', [ContactoController::class, 'contacto']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';




<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EstudiantesController;
use App\Http\Controllers\FacilitadoresController;
use App\Http\Controllers\MateriasController;
use App\Http\Controllers\NotasController;
use App\Http\Controllers\RolesController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('dashboard_test_modern');
})->name('dashboard');

// Ruta para cerrar sesión
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');


Route::get('/estudiantes', [EstudiantesController::class, 'index'])->name('estudiantes.index');
Route::get('/estudiantes/create', [EstudiantesController::class, 'create'])->name('estudiantes.create');
Route::post('/estudiantes', [EstudiantesController::class, 'store'])->name('estudiantes.store');
Route::get('/estudiantes/{id}', [EstudiantesController::class, 'show'])->name('estudiantes.show');
Route::get('/estudiantes/{id}/edit', [EstudiantesController::class, 'edit'])->name('estudiantes.edit');
Route::put('/estudiantes/{id}', [EstudiantesController::class, 'update'])->name('estudiantes.update');
Route::delete('/estudiantes/{id}', [EstudiantesController::class, 'destroy'])->name('estudiantes.destroy');

Route::get('/facilitadores', [FacilitadoresController::class, 'index'])->name('facilitadores.index');
Route::get('/facilitadores/create', [FacilitadoresController::class, 'create'])->name('facilitadores.create');
Route::post('/facilitadores', [FacilitadoresController::class, 'store'])->name('facilitadores.store');
Route::get('/facilitadores/{id}', [FacilitadoresController::class, 'show'])->name('facilitadores.show');
Route::get('/facilitadores/{id}/edit', [FacilitadoresController::class, 'edit'])->name('facilitadores.edit');
Route::put('/facilitadores/{id}', [FacilitadoresController::class, 'update'])->name('facilitadores.update');
Route::delete('/facilitadores/{id}', [FacilitadoresController::class, 'destroy'])->name('facilitadores.destroy');

Route::get('/materias', [MateriasController::class, 'index'])->name('materias.index');
Route::get('/notas', [NotasController::class, 'index'])->name('notas.index');
Route::get('/roles', [RolesController::class, 'index'])->name('roles.index');

<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HijoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/vacunas/buscar', [AdminController::class, 'searchVacuna'])->name('vacuna.search');
Route::get('/vacunas', [AdminController::class, 'index'])->name('vacuna.index');
Route::post('/vacunas/crear', [AdminController::class, 'createVacunas'])->name('vacuna.crear');

Route::get('/hijos', [HijoController::class, 'index'])->name('hijo.index');
Route::get('/hijos/buscar', [HijoController::class, 'searchHijo'])->name('hijo.search');
Route::get('/hijos/vacunas/buscar', [HijoController::class, 'searchVacunasHijo'])->name('hijo.search-vacunas');
Route::post('/hijos/crear', [HijoController::class, 'createHijo'])->name('hijo.create');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

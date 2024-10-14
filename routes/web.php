<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InicioController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// VIEW

Route::get('/', function () {

    return redirect()->route('index');
});


// INICIO //

// Para redirigir a index de pagina
Route::get('/index', [InicioController::class, 'index'])->name('index');

// Ruta para mostrar el historial de subida de una Raspberry específica
Route::get('/historial/{codigo}', [InicioController::class, 'showHistorial'])->name('historial');

Route::get('/historial/{codigo}/json', [InicioController::class, 'fetchHistorialJson'])->name('fetchHistorialJson');

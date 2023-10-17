<?php

use App\Http\Controllers\CasoController;
use App\Http\Controllers\DashboardController;
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

// Route::get('/products', [ProductoController::class, 'show'])->name('products.show');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/casos', [CasoController::class, 'show_cases'])->name('show.cases');
Route::get('/soporte', [CasoController::class, 'show_soporte'])->name('show.soporte');
Route::get('/caso/{id}', [CasoController::class, 'show'])->name('show.case');

Route::get('/report/casos', [CasoController::class, 'generatePdfCasos'])->name('generate.report.casos');
Route::get('/report/caso/{id}', [CasoController::class, 'generatePdf'])->name('generate.report');

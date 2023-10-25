<?php

use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProfileController;
use App\Models\Order;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    $orders =  Order::with(['muestras.identificacionMuestraRelacion', 'cliente', 'siralab'])
    ->orderBy('fecha_recepcion', 'desc')
    ->orderBy('hora_recepcion', 'desc')
    ->orderBy('cesavedac', 'asc')
    ->orderBy('folio', 'desc')
    ->paginate(40);
    $page = request()->query('page') ? request()->query('page'):null;
    return Inertia::render('Dashboard', [
        'ordersProp' => $orders,
        'page' => $page
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('/orders')->group(function () {
    Route::post('/toggle-cesavedac', [OrdersController::class, 'toggleCesavedac']);
    Route::post('/toggle-supervision', [OrdersController::class, 'toggleSupervision']);
    Route::post('/toggle-hoja-campo', [OrdersController::class, 'toggleHojaCampo']);
    Route::post('/toggle-cadena-custodia', [OrdersController::class, 'toggleCadenaCustodia']);
    Route::post('/toggle-croquis', [OrdersController::class, 'toggleCroquis']);
    Route::post('/toggle-reporte-entregado', [OrdersController::class, 'toggleReporteEntregado']);
    Route::get('/filter', [OrdersController::class, 'filter']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

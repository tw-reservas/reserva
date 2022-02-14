<?php

use App\Http\Controllers\Admin\AreaController;
use App\Http\Controllers\Admin\CalendarioController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CupoController;
use App\Http\Controllers\Admin\DetalleCalendarioController;
use App\Http\Controllers\Admin\GrupoController;
use App\Http\Controllers\Admin\LaboratorioController;
use App\Http\Controllers\Admin\RequisitoController;
use App\Http\Controllers\Admin\ReservaController;
use App\Http\Controllers\Admin\RolController;
use App\Http\Controllers\Admin\ThemeController;
use App\Http\Controllers\Admin\UserController;

//theme change
Route::post('/theme', [ThemeController::class, 'themes'])->name('theme.themes');
Route::get('/theme', [ThemeController::class, 'mostrar'])->name('theme.mostrar');

Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home');
Route::resource('cupo', CupoController::class);
Route::get('cupo/activar/{cupo}', [CupoController::class, 'activar'])->name('activar.cupo');
Route::resource('grupo', GrupoController::class)->only(['index', 'create', 'store', 'destroy']);
Route::get('grupo/activar/{grupo}', [GrupoController::class, 'activar'])->name('grupo.activar');
Route::get('grupo/config-porcentaje', [GrupoController::class, 'porcentajeView'])->name('grupo.conf-porcentaje');
Route::post('grupo/config-porcentaje', [GrupoController::class, 'storePorcentaje'])->name('grupo.conf-porcentaje');


Route::resource('calendario', CalendarioController::class)->only(['index', 'create', 'store', 'destroy']);
Route::get('detalle-calendario', [DetalleCalendarioController::class, 'index'])->name('detalle-calendario.index');
Route::get('detalle-calendario/repartir/{calendario}/cupo/{cupo}', [DetalleCalendarioController::class, 'repartir'])->name('detalle-calendario.repartir');
Route::get('detalle-calendario/ver/{calendario}', [DetalleCalendarioController::class, 'verDetalles'])->name('detalle-calendario.ver');


//Brenda Casos de uso
//laboratorios
Route::get('laboratorios', [LaboratorioController::class, 'index']);
//laboratorios end
//area
Route::get('areas', [AreaController::class, 'index']);
//area end
//area
Route::get('requisitos', [RequisitoController::class, 'index']);
//area end
Route::resource('user', UserController::class);

//* reserva rutas *//
Route::post('reserva', [ReservaController::class, 'verificarUserAndOrden'])->name('reserva.verificar-matricula-orden');
Route::get('reserva', [ReservaController::class, 'index'])->name('reserva.index');

/* Route Rol */
Route::resource('rol', RolController::class);

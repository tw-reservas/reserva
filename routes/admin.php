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
use App\Http\Controllers\AdministrarContrasena;

//theme change
Route::post('/theme', [ThemeController::class, 'themes'])->name('theme.themes');
Route::get('/theme', [ThemeController::class, 'mostrar'])->name('theme.mostrar');

Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home');
Route::resource('cupo', CupoController::class);
Route::get('cupo/activar/{cupo}', [CupoController::class, 'activar'])->name('activar.cupo');
Route::resource('grupo', GrupoController::class)->only(['index', 'create', 'store', 'destroy']);
Route::get('grupo/activar/{grupo}', [GrupoController::class, 'activar'])->name('grupo.activar');
Route::get('grupo/config-porcentaje', [GrupoController::class, 'porcentajeView'])->name('grupo.conf-porcentaje.get');
Route::post('grupo/config-porcentaje', [GrupoController::class, 'storePorcentaje'])->name('grupo.conf-porcentaje.post');


Route::resource('calendario', CalendarioController::class)->only(['index', 'create', 'store', 'destroy']);
Route::get('detalle-calendario', [DetalleCalendarioController::class, 'index'])->name('detalle-calendario.index');
Route::get('detalle-calendario/repartir/{calendario}/cupo/{cupo}', [DetalleCalendarioController::class, 'repartir'])->name('detalle-calendario.repartir');
Route::get('detalle-calendario/ver/{calendario}', [DetalleCalendarioController::class, 'verDetalles'])->name('detalle-calendario.ver');


//Brenda Casos de uso
//laboratorios
Route::get('laboratorios', [LaboratorioController::class, 'index'])->name('laboratorios.index');
Route::get('laboratorios/create', [LaboratorioController::class, 'create'])->name('laboratorios.create');
Route::post('laboratorios', [LaboratorioController::class, 'store'])->name('laboratorios.store');
Route::get('laboratorios/{laboratorio}', [LaboratorioController::class, 'edit'])->name('laboratorios.edit');
Route::put('laboratorios/{laboratorio}', [LaboratorioController::class, 'update'])->name('laboratorios.update');
Route::delete('laboratorios/{laboratorio}', [LaboratorioController::class, 'destroy'])->name('laboratorios.delete');

//laboratorios end

//area
Route::get('areas', [AreaController::class, 'index'])->name('area.index');
Route::get('areas/create', [AreaController::class, 'create'])->name('area.create');
Route::post('areas', [AreaController::class, 'store'])->name('area.store');
Route::get('areas/{area}', [AreaController::class, 'edit'])->name('area.edit');
Route::put('areas/{area}', [AreaController::class, 'update'])->name('area.update');
Route::delete('areas/{area}', [AreaController::class, 'destroy'])->name('area.delete');
//area end
//requisito
Route::get('requisitos', [RequisitoController::class, 'index'])->name('requisitos.index');
Route::get('requisitos/create', [RequisitoController::class, 'create'])->name('requisitos.create');
Route::post('requisitos', [RequisitoController::class, 'store'])->name('requisitos.store');
Route::get('requisitos/{requisito}', [RequisitoController::class, 'edit'])->name('requisitos.edit');
Route::put('requisitos/{requisito}', [RequisitoController::class, 'update'])->name('requisitos.update');
Route::delete('requisitos/{requisito}', [RequisitoController::class, 'destroy'])->name('requisitos.delete');
//requisito end

Route::resource('user', UserController::class);

//* reserva rutas *//
Route::post('reserva', [ReservaController::class, 'verificarUserAndOrden'])->name('reserva.verificar-matricula-orden');
Route::get('reserva', [ReservaController::class, 'index'])->name('reserva.index');

/* Route Rol */
Route::resource('rol', RolController::class);

Route::post('restablecer-contra', [AdministrarContrasena::class, "restorePassword"])->name("restore.password");
Route::get('restablecer-contra', [AdministrarContrasena::class, "showRestorePassword"])->name("show.restore.password");

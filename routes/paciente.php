<?php

use App\Http\Controllers\Paciente\ReservaController;
use App\Http\Controllers\ResultadoController;
use Illuminate\Support\Facades\Route;


Route::get('/', [ReservaController::class, 'index'])->name('paciente.home');


Route::post('/', [ReservaController::class, 'verificarCodLab'])->name('verificar.orden');


Route::get("reserva/ver", [ReservaController::class, 'ver'])->name('ver-reserva');


Route::get("reserva/{orden}/date/{date}", [ReservaController::class, 'grupos'])->name('get-grupos');
Route::get("reserva/{ordenlab}/detalle/{detalle_id}", [ReservaController::class, 'reservar'])->name('reservar');

Route::get("reserva/resultado", [ResultadoController::class, 'index'])->name('ver-resultado');

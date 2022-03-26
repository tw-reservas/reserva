<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CalendarioController;
use App\Http\Controllers\Api\GrupoController;
use App\Http\Controllers\Api\OrdenLabController;
use App\Http\Controllers\Api\ReservaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [AuthController::class, 'validateData']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('orden', [OrdenLabController::class, 'validateOrdenLab']);

    Route::get('reserva/calendario', [CalendarioController::class, 'calendario']);
    Route::get('reserva/calendario/{fecha}/grupos', [GrupoController::class, 'getGrupos']);
    Route::post('reserva/reservar', [ReservaController::class, 'reservar']);
    Route::get('boleta/{reserva}', [ReservaController::class, 'verReserva']);
    Route::get('logout', [AuthController::class, 'logout']);
});

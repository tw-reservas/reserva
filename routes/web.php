<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
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



Route::prefix('admin')->group(function () {
    Auth::routes();
});

Route::get('/', function () {
    return view('welcome');
})->name('login.paciente.home');
Route::post('login/paciente', [LoginController::class, 'loginPaciente'])->name('login.paciente');
Route::post('logout/paciente', [LoginController::class, 'salir'])->name('logout.paciente');

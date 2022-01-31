<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AuthPaciente\LoginPacienteController;
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



/*Route::prefix('admin')->group(function () {
    Auth::routes();
});*/

/*Route::get('/', function () {
    return view('welcome');
})->name('login.paciente.home');*/

Route::get('/', [LoginPacienteController::class, 'showLoginForm'])->name('paciente.login');
Route::post('login', [LoginPacienteController::class, 'login'])->name('paciente.post');

Route::post('logout', [LoginPacienteController::class, 'salir'])->name('logout.paciente')->middleware('auth:paciente');

Route::get('admin/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [LoginController::class, 'login'])->name('admin.post');
Route::post('admin/logout', [LoginController::class, 'logout'])->name('admin.logout')->middleware('auth:admin');

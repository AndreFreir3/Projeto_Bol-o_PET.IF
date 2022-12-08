<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ApostaController;
use App\Http\Controllers\UsuariosController;
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
Route::post('/aposta/update', [ApostaController::class, 'update'])->name('apostas.update')->middleware('auth');
Route::resource('apostas', ApostaController::class)->except('update')->middleware('auth');

//Route::get('/apostas', [ApostaController::class, 'index'])->name('welcome');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/cadastrar', [LoginController::class, 'cadastrar'])->name('cadastrar');
Route::get('/', [HomeController::class, 'index'])->name('welcome');

//controle de usuario
Route::get('usuarios', [UsuariosController::class, 'index'])->name('usuarios')->middleware('auth');
Route::get('usuario/{id}', [UsuariosController::class, 'show'])->name('usuario')->middleware('auth');
Route::post('usuario/{id}', [UsuariosController::class, 'update'])->name('usuario.update')->middleware('auth');





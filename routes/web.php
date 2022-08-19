<?php

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

Route::get('/notas', [App\Http\Controllers\NotasController::class, 'index'])->name('notas');
Route::get('/notas/search', [App\Http\Controllers\NotasController::class, 'search'])->name('search');

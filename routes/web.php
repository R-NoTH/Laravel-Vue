<?php

use App\Http\Controllers\ArticuloController;
use App\Http\Controllers\BookController;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// articulos
Route::apiResource('/articulos', ArticuloController::class);

// books
Route::get('/books', [BookController::class,'index']);
Route::get('/books/listar', [BookController::class,'listarBooks']);



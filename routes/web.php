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

/*
Route::get('/', function () {
    return view('welcome');
});
*/
Route::get('/', [App\Http\Controllers\BookController::class, 'index']);

Auth::routes();

Route::get('books/{id}/confirm', [App\Http\Controllers\BookController::class,'confirmBook'])->name('confirmBook');
Route::resource('books', App\Http\Controllers\BookController::class);

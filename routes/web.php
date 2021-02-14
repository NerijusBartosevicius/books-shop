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
Route::get('/', [App\Http\Controllers\User\BookController::class, 'index']);

Auth::routes();
Route::group(['middleware' => 'auth'],function () {

    Route::get('/dashboard',function (){
        return view('welcome');
    });

    Route::group(['prefix' => 'user', 'as' =>'user.'],function (){
        Route::get('my-books', [App\Http\Controllers\User\BookController::class, 'myBooks'])->name('myBooks');
        Route::resource('books', App\Http\Controllers\User\BookController::class);
    });

    Route::group(['middleware' => 'isAdmin','prefix' => 'admin', 'as' =>'admin.'],function (){
        Route::resource('books', App\Http\Controllers\Admin\BookController::class);
        Route::resource('users', App\Http\Controllers\Admin\UserController::class);
    });
});
//Route::get('books/{id}/confirm', [App\Http\Controllers\BookController::class,'confirmBook'])->name('confirmBook');
//Route::get('books/{id}/remove-cover', [App\Http\Controllers\BookController::class,'removeCover'])->name('removeCover');
//Route::resource('books', App\Http\Controllers\BookController::class);

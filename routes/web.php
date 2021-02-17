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
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/books/{id}', [App\Http\Controllers\HomeController::class, 'show'])->name('books');

Auth::routes();
Route::group(['middleware' => 'auth'],function () {

    Route::get('/dashboard',function (){
        return redirect()->route('home');
    });

    Route::group(['prefix' => 'user', 'as' =>'user.'],function (){
        Route::post('review', [App\Http\Controllers\User\BookReviewController::class, 'store'])->name('review');
        Route::get('my-books', [App\Http\Controllers\User\BookController::class, 'myBooks'])->name('myBooks');
        Route::get('books/{id}/report', [App\Http\Controllers\User\BookController::class, 'reportBook'])->name('books.reportBook');
        Route::resource('books', App\Http\Controllers\User\BookController::class);

        // User settings
        Route::get('settings', [App\Http\Controllers\User\SettingsController::class, 'index'])->name('settings');
        Route::post('settings', [App\Http\Controllers\User\SettingsController::class, 'updateUserData'])->name('updateUserData');
        Route::post('settings/password', [App\Http\Controllers\User\SettingsController::class, 'updateUserPassword'])->name('updateUserPassword');
    });

    Route::group(['middleware' => 'isAdmin','prefix' => 'admin', 'as' =>'admin.'],function (){
        Route::get('books/{id}/confirmBook', [App\Http\Controllers\Admin\BookController::class, 'confirmBook'])->name('books.confirmBook');
        Route::resource('users', App\Http\Controllers\Admin\UserController::class)->except(['view','create']);
    });
});

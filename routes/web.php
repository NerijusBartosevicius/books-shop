<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/books/{book}', [App\Http\Controllers\HomeController::class, 'show'])->name('books');
Route::get('/cart', \App\Http\Controllers\User\CartController::class)->name('cart');
Route::post('payment/payment-charge', [\App\Http\Controllers\Payment\PaymentController::class,'charge'])->name('payment.charge');
Route::get('payment/success', [\App\Http\Controllers\Payment\PaymentController::class,'paymentSuccess'])->name('payment.success');
Route::get('payment/list', [\App\Http\Controllers\Payment\PaymentController::class,'paymentList'])->name('payment.list');
Route::stripeWebhooks('stripe-webhook');

Auth::routes();
Route::group(['middleware' => 'auth'],function () {

    Route::get('/dashboard',function (){
        return redirect()->route('home');
    });

    Route::group(['prefix' => 'user', 'as' =>'user.'],function (){
        Route::get('books/my-books', [App\Http\Controllers\User\BookController::class, 'myBooks'])->name('books.myBooks');
        Route::get('books/{book}/report', [App\Http\Controllers\User\BookController::class, 'reportBook'])->name('books.reportBook');
        Route::resource('books', App\Http\Controllers\User\BookController::class);

        // User settings
        Route::get('settings', [App\Http\Controllers\User\SettingsController::class, 'index'])->name('settings');
        Route::post('settings', [App\Http\Controllers\User\SettingsController::class, 'updateUserData'])->name('updateUserData');
        Route::post('settings/password', [App\Http\Controllers\User\SettingsController::class, 'updateUserPassword'])->name('updateUserPassword');
    });

    Route::group(['middleware' => 'isAdmin','prefix' => 'admin', 'as' =>'admin.'],function (){
        Route::put('books/{id}/confirmBook', [App\Http\Controllers\Admin\BookController::class, 'confirmBook'])->name('books.confirmBook');
        Route::resource('users', App\Http\Controllers\Admin\UserController::class)->except(['show','create']);
    });
});

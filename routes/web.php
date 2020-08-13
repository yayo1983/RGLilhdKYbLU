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

Auth::routes();

/**
 * close session
 */
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'PaymentController@index')->name('payment.index');

    Route::get('/home', 'PaymentController@index')->name('payment.index\'');

// Payment
    Route::get('/payment', 'PaymentController@index')->name('payment.index');

    Route::get('/paymentcreate', 'PaymentController@create')->name('payment.create');

    Route::post('/paymentstore', 'PaymentController@store')->name('payment.store');

    Route::get('/paymentshow', 'PaymentController@show')->name('payment.show');

    Route::get('/paymenttest', 'PaymentController@indexText')->name('payment.indexText');
});

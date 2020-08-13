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
//Route::get('/', 'PaymentController@index')->name('payment.index');
/*Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('welcome');
});*/
Auth::routes();

/**
 * Las routas que estan dentro del route::group solo serán mostradas si el usuario esta autenticado
 */
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'PaymentController@index')->name('payment.index');

    Route::get('/home', 'PaymentController@index')->name('payment.index\'');

// Payment
    Route::get('/payment', 'PaymentController@index')->name('payment.index');

    Route::get('/paymentcreate', 'PaymentController@create')->name('payment.create');

    Route::post('/paymentstore', 'PaymentController@store')->name('payment.store');

    Route::get('/paymentshow', 'PaymentController@show')->name('payment.show');
});

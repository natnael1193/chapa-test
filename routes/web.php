<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// The page that displays the payment form
Route::get('/', function () {
    return view('welcome');
});
// The route that the button calls to initialize payment

// Route::post('pay', 'App\Http\Controllers\ChapaController@initialize')->name('pay');

// // The callback url after a payment
// Route::get('callback/{reference}', 'App\Http\Controllers\ChapaController@callback')->name('callback');
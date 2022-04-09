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

Route::get('/', [\App\Http\Controllers\Controller::class,'index']);
// route resource for goods
Route::resource('goods', \App\Http\Controllers\GoodsController::class);
Route::resource('variety', \App\Http\Controllers\GoodVarietyController::class);
Route::resource('payment', \App\Http\Controllers\PaymentController::class);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

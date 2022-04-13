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

Route::get('/', [\App\Http\Controllers\Controller::class,'index'])->name('dashboard');
// route resource for goods
Route::resource('goods', \App\Http\Controllers\GoodsController::class);
Route::resource('variety', \App\Http\Controllers\GoodVarietyController::class);

Route::resource('payments', \App\Http\Controllers\PaymentsController::class);
Route::resource('orders', \App\Http\Controllers\OrderController::class);
Route::resource('users', \App\Http\Controllers\UsersController::class);


//Route::get('/home', [App\Http\Controllers\ProductViewController::class, 'productInfo'])->name('home');
//Route::get('/home', [App\Http\Controllers\ProductViewController::class, 'productInfo'])->name('home');
Route::get('/filterCategory/{category_id}', [\App\Http\Controllers\Controller::class, 'filterGoodBasedOnCategory'])->name('filterCategory');


